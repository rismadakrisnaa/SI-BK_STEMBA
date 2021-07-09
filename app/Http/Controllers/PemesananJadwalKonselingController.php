<?php

namespace App\Http\Controllers;

use App\Models\GuruBk;
use App\Models\Kelasjurusan;
use App\Models\PemesananJadwalKonseling;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PemesananJadwalKonselingController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:gurubk', ['only'=>['permintaan']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa=Siswa::with('kelas')->get();
        $guruBk = GuruBk::all();
        $pesertaKonseling = PemesananJadwalKonseling::with('guruBk')->get();
        $pesertaKonseling = $pesertaKonseling->filter(function($siswa, $index){
            if(Gate::allows('admin')){
                return true;
            }else if(Gate::allows('gurubk')){
                return $siswa->guru_bk_id==auth()->user()->gurubk[0]->_id;
            }
            return $siswa->siswa->_id==auth()->user()->siswa[0]->_id;
        });
        $classes = Kelasjurusan::all();
        return view('konseling.pemesanan_jadwal.index',compact('guruBk','pesertaKonseling','classes','siswa'));
    }

    public function permintaan()
    {
        $pesertaKonseling = PemesananJadwalKonseling::with('guruBk')->get();
        $pesertaKonseling = $pesertaKonseling->filter(function($siswa, $index){
            if(Gate::allows('admin')){
                return true;
            }else if(Gate::allows('gurubk')){
                return $siswa->guru_bk_id==auth()->user()->gurubk[0]->_id;
            }
            return $siswa->siswa->_id==auth()->user()->siswa[0]->_id;
        });
        return view('konseling.permintaan.index',compact('pesertaKonseling'));
    }

    public function response(PemesananJadwalKonseling $permintaanKonseling)
    {
        return view('konseling.permintaan.response',compact('permintaanKonseling'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id'=>'required_if:panggilan,1',
            'siswa_id'=>'required_if:panggilan,1',
            'perihal_bimbingan'=>'required',
            'jadwal'=>'required_if:panggilan,1|date_format:Y-m-d',
            'guru_bk_id'=>'required_if:panggilan,0'
        ],[
            'kelas_id.required_if'=>'Kelas harus dipilih!',
            'siswa_id.required_if'=>'Siswa harus dipilih!',
            'perihal_bimbingan.required'=>'Perihal bimbingan harus diisi!',
            'guru_bk_id.required_if'=>'Guru BK harus dipilih!',
            'jadwal.required_if'=>'Jadwal harus ditentukan!',

        ]);
        $data=$request->all();
        if(auth()->user()->role=='siswa'){
            $data['kelas_id']=auth()->user()->siswa[0]->kelas_id;
            $data['siswa_id']=auth()->user()->siswa[0]->_id;
        }else if(auth()->user()->role=='gurubk'){
            $data['guru_bk_id']=auth()->user()->gurubk[0]->_id;
        }
        $data['status']='pending';
        PemesananJadwalKonseling::create($data);
        return back()->with('alert-success','Pesanan Jadwal Konseling berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PemesananJadwalKonseling  $pemesananJadwalKonseling
     * @return \Illuminate\Http\Response
     */
    public function show(PemesananJadwalKonseling $pemesananJadwalKonseling)
    {
        $pemesananJadwalKonseling->guruBk;
        $pemesananJadwalKonseling->siswa;
        $pemesananJadwalKonseling->classes;
        return request()->ajax()?response()->json($pemesananJadwalKonseling):abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PemesananJadwalKonseling  $pemesananJadwalKonseling
     * @return \Illuminate\Http\Response
     */
    public function edit(PemesananJadwalKonseling $pemesananJadwalKonseling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PemesananJadwalKonseling  $pemesananJadwalKonseling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PemesananJadwalKonseling $pemesananJadwalKonseling)
    {
        $pemesananJadwalKonseling->update($request->all());
        return back()->with('alert-success','Data Pemesanan Jadwal Konseling berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PemesananJadwalKonseling  $pemesananJadwalKonseling
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemesananJadwalKonseling $pemesananJadwalKonseling)
    {
        $oldName = $pemesananJadwalKonseling->nama;
        $pemesananJadwalKonseling->delete();
        return back()->with('alert-success','Pesanan Jadwal Konseling '.$oldName.' berhasil dihapus');
    }
}

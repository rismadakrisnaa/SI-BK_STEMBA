<?php

namespace App\Http\Controllers;

use App\Models\GuruBk;
use App\Models\Kelasjurusan;
use App\Models\PemesananJadwalKonseling;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PemesananJadwalKonselingController extends Controller
{
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
        $classes = Kelasjurusan::all();
        return view('konseling.pemesanan_jadwal.index',compact('guruBk','pesertaKonseling','classes','siswa'));
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
            'siswa_id'=>'required',
            'jadwal'=>'required|date',
            'pukul'=>'required',
            'perihal_bimbingan'=>'required',
            'guru_bk_id'=>'required'
        ]);

        PemesananJadwalKonseling::create($request->all());
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
        //
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

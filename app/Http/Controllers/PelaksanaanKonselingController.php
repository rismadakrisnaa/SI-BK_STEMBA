<?php

namespace App\Http\Controllers;

use App\Models\GuruBk;
use App\Models\Kelasjurusan;
use App\Models\PemesananJadwalKonseling;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PelaksanaanKonselingController extends Controller
{
    public function __construct()
    {

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
        $classes = Kelasjurusan::all();
        return view('konseling.pelaksanaan.index',compact('guruBk','pesertaKonseling','classes','siswa'));
    }

    public function hasil()
    {
        $pesertaKonseling = PemesananJadwalKonseling::with('guruBk')->where('status','approve')->get();
        $pesertaKonseling = $pesertaKonseling->filter(function($konseling,$index){
            if(Gate::allows('gurubk')){
                return $konseling->guru_bk_id==auth()->user()->gurubk[0]->_id;
            }
            return $konseling->siswa_id==auth()->user()->siswa[0]->_id;
        });
        return view('konseling.history.index',compact('pesertaKonseling'));
    }

    public function edit_hasil(PemesananJadwalKonseling $konseling)
    {
        return view('konseling.history.hasil', compact('konseling'));
    }

    public function panggilan()
    {
        $pesertaKonseling = PemesananJadwalKonseling::with('guruBk')->where('status','approve')
                                                      ->where('siswa_id',auth()->user()->siswa[0]->_id)->get();
        return view('konseling.panggilan.index',compact('pesertaKonseling'));
    }

    public function cetak(Request $request)
    {
        $peserta=PemesananJadwalKonseling::with('guruBk')->where('_id',$request->id)->first();
        $pdf = \PDF::loadView('pdf.hasil',compact('peserta'));
        return $pdf->stream('Pelaksanaan Konseling.pdf');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

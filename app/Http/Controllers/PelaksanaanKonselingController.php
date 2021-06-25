<?php

namespace App\Http\Controllers;

use App\Models\GuruBk;
use App\Models\Kelasjurusan;
use App\Models\PemesananJadwalKonseling;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PelaksanaanKonselingController extends Controller
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
        return view('konseling.pelaksanaan.index',compact('guruBk','pesertaKonseling','classes','siswa'));
    }

    public function hasil()
    {
        $siswa=Siswa::with('kelas')->get();
        $guruBk = GuruBk::all();
        $pesertaKonseling = PemesananJadwalKonseling::with('guruBk')->get();
        $classes = Kelasjurusan::all();
        return view('konseling.history.index',compact('guruBk','pesertaKonseling','classes','siswa'));
    }

    public function cetak(Request $request)
    {
        $peserta=PemesananJadwalKonseling::with('guruBk')->where('_id',$request->id)->first();
        $pdf = \PDF::loadView('pdf.hasil',compact('peserta'));
        return $pdf->stream('contoh.pdf');
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

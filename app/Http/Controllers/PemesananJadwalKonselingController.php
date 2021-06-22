<?php

namespace App\Http\Controllers;

use App\Models\GuruBk;
use App\Models\PemesananJadwalKonseling;
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
        $guruBk = GuruBk::all();
        $pesertaKonseling = PemesananJadwalKonseling::with('guruBk')->get();
        return view('konseling.pemesanan_jadwal.index',compact('guruBk','pesertaKonseling'));
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
            'nama'=>'required',
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

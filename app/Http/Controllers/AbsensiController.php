<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelasjurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes=Kelasjurusan::all();
        $classes=$classes->filter(function($item,$index){
            return Gate::allows('kelas-ku',$item);
        });
        return view('absensi.index',compact('classes'));
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
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Kelasjurusan $absensi)
    {
        $kode=$absensi->kelasjurusan_kode;
        $absenToday=Absensi::where('kelas_id',$kode)->whereRaw(DB::raw("DATE(created_at) = '".date('Y-m-d')."'"))->get();
        $absenToday=$absenToday->filter(function($item){
            return $item->created_at->format('d-m-Y')==date('d-m-Y');
        });
        $absenan=['h'=>'Hadir','a'=>'Alfa','i'=>'Izin','s'=>'Sakit'];
        return view('absensi.show',compact('absensi','absenToday','absenan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelasjurusan $absensi)
    {
        $kode=$absensi->kelasjurusan_kode;
        $absenToday=Absensi::where('kelas_id',$kode)->get();
        $absenToday=$absenToday->filter(function($item){
            return $item->created_at->format('d-m-Y')==date('d-m-Y');
        });
        if($absenToday->isEmpty()){
            foreach($request->absen as $id => $absen){
                Absensi::create(['absen'=>$absen,'siswa_id'=>$id,'kelas_id'=>$kode]);
            }
            return back()->with('alert-success','Absensi siswa berhasil diinput.');
        }else{
            foreach($request->absen as $siswa_id => $absen){
                $updateAbsen=Absensi::firstOrCreate([
                    '_id'=>$absenToday->where('siswa_id',$siswa_id)->first()->_id??'0',
                    'siswa_id'=>$siswa_id,
                ],[
                    'absen'=>$absen,
                    'kelas_id'=>$kode
                ]);
                $updateAbsen->update(['absen'=>$absen]);
            }
            return back()->with('alert-success','Absensi siswa berhasil diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}

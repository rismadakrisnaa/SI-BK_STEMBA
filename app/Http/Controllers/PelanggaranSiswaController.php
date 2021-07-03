<?php

namespace App\Http\Controllers;

use App\Models\PelanggaranSiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PelanggaranSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pelanggaran-siswa.index');
    }

    public function ajax(Request $request)
    {
        // if(!$request->ajax())return abort(403,'Permintaan harus ajax');
        $model=PelanggaranSiswa::with(['pelanggaran','siswa','siswa.kelas']);

        if($request->kelas!='')
        {
            $model->where('kelas_id',$request->kelas);
        }
        if($request->has('orderBy')&&$request->orderBy!='default'){
            $model->orderBy('point',$request->orderBy);
        }
        $model=collect($model->get());
        foreach($model as $m => $d){
            $model[$m]['no']=$m+1;
        }

        return DataTables::collection($model)
        ->addColumn('action',function($data){
            return view('pelanggaran-siswa._action',compact('data'));
        })
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggaran-siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token','point','input','bukti_foto');
        $data['point']=explode(' ',$request->point)[0];
        if($request->hasFile('bukti_foto')){
            $bukti=$request->file('bukti_foto');
            $nama_file=time().'.'.$bukti->getClientOriginalExtension();
            $bukti->move('images/bukti_foto/',$nama_file);
        }
        $data['bukti_foto']=$nama_file??'';
        PelanggaranSiswa::create($data);
        return redirect()->route('pelanggaran-siswa.index')->with('alert-success','Siswa berhasil dilaporkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PelanggaranSiswa  $pelanggaranSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(PelanggaranSiswa $pelanggaranSiswa)
    {
        return view('pelanggaran-siswa.show',compact('pelanggaranSiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PelanggaranSiswa  $pelanggaranSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(PelanggaranSiswa $pelanggaranSiswa)
    {
        $pelanggaranSiswa->pelanggaran;
        $pelanggaranSiswa->siswa;
        $pelanggaranSiswa->siswa->kelas;
        return request()->ajax()?response()->json($pelanggaranSiswa):view('pelanggaran-siswa.edit',compact('pelanggaranSiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PelanggaranSiswa  $pelanggaranSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelanggaranSiswa $pelanggaranSiswa)
    {
        $bukti_foto=$pelanggaranSiswa->bukti_foto;
        $data=$request->except('_token','input','_method','point','bukti_foto');
        $data['point']=explode(' ',$request->point)[0];
        $pelanggaranSiswa->update($data);
        if($request->hasFile('bukti_foto')){
            $request->file('bukti_foto')->move('images/bukti_foto',$bukti_foto);
        }
        return redirect()->route('pelanggaran-siswa.index')->with('alert-success','Pelanggaran siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PelanggaranSiswa  $pelanggaranSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(PelanggaranSiswa $pelanggaranSiswa)
    {
        if(file_exists(base_path('public/images/bukti_foto/'.$pelanggaranSiswa->bukti_foto))){
            unlink(base_path('public/images/bukti_foto/'.$pelanggaranSiswa->bukti_foto));
        }
        $pelanggaranSiswa->delete();
        return redirect()->route('pelanggaran-siswa.index')->with('alert-success','Pelanggaran siswa berhasil dihapus.');
    }
}

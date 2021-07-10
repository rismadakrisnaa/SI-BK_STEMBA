<?php

namespace App\Http\Controllers;

use App\Models\PanggilanOrtu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PanggilanOrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panggilan-ortu.index');
    }

    public function ajax(Request $request)
    {
        $model=PanggilanOrtu::with(['siswa','siswa.kelas','guruBk']);

        if($request->kelas!='')
        {
            $model->where('kelas_id',$request->kelas);
        }

        $model=collect($model->get());
        foreach($model as $m => $d){
            $model[$m]['no']=$m+1;
        }

        return DataTables::collection($model)
        ->editColumn('tanggal_panggilan', function($data){
            return $data->tanggal_panggilan.' '.$data->pukul;
        })
        ->addColumn('action',function($data){
            return view('panggilan-ortu._action',compact('data'));
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
        return view('panggilan-ortu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PanggilanOrtu::create($request->except('_token','input'));
        return redirect()->route('panggilan-ortu.index')->with('alert-success','Panggilan Orang Tua berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PanggilanOrtu  $panggilanOrtu
     * @return \Illuminate\Http\Response
     */
    public function show(PanggilanOrtu $panggilanOrtu)
    {
        return view('panggilan-ortu.show',compact('panggilanOrtu'));
    }

    public function cetak(PanggilanOrtu $panggilanOrtu)
    {
        $pdf = \PDF::loadView('pdf.panggilan-ortu',compact('panggilanOrtu'));
        return $pdf->stream('SURAT HOME VISIT.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PanggilanOrtu  $panggilanOrtu
     * @return \Illuminate\Http\Response
     */
    public function edit(PanggilanOrtu $panggilanOrtu)
    {
        return request()->ajax()?response()->json($panggilanOrtu):view('panggilan-ortu.edit',compact('panggilanOrtu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PanggilanOrtu  $panggilanOrtu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PanggilanOrtu $panggilanOrtu)
    {
        $panggilanOrtu->update($request->except('_token','_method','input'));
        return redirect()->route('panggilan-ortu.index')->with('alert-success','Panggilan Orang Tua berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PanggilanOrtu  $panggilanOrtu
     * @return \Illuminate\Http\Response
     */
    public function destroy(PanggilanOrtu $panggilanOrtu)
    {
        $panggilanOrtu->delete();
        return back()->with('alert-success','Panggilan Orang Tua berhasil dihapus.');
    }
}

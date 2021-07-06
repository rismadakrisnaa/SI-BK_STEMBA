<?php

namespace App\Http\Controllers;

use App\Models\HomeVisit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HomeVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home-visit.index');
    }

    public function ajax(Request $request)
    {
        // if(!$request->ajax())return abort(403,'Permintaan harus ajax');
        $model=HomeVisit::with(['pelanggaran','siswa','siswa.kelas']);

        if($request->kelas!='')
        {
            $model->where('kelas_id',$request->kelas);
        }

        $model=collect($model->get());
        foreach($model as $m => $d){
            $model[$m]['no']=$m+1;
        }

        return DataTables::collection($model)
        ->addColumn('action',function($data){
            return view('home-visit._action',compact('data'));
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
        return view('home-visit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HomeVisit::create($request->except('_token','input'));
        return redirect()->route('home-visit.index')->with('alert-success','Home Visit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeVisit  $homeVisit
     * @return \Illuminate\Http\Response
     */
    public function show(HomeVisit $homeVisit)
    {
        // dd($homeVisit->guru)
        return view('home-visit.show',compact('homeVisit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeVisit  $homeVisit
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeVisit $homeVisit)
    {
        $homeVisit->siswa;$homeVisit->pelanggaran;
        return request()->ajax()?response()->json($homeVisit):view('home-visit.edit',compact('homeVisit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeVisit  $homeVisit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeVisit $homeVisit)
    {
        $homeVisit->update($request->except('input'));
        return redirect()->route('home-visit.index')->with('alert-success','Home Visit berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeVisit  $homeVisit
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeVisit $homeVisit)
    {
        $homeVisit->delete();
        return back()->with('alert-success','Home Visit Berhasil dihapus.');
    }
}

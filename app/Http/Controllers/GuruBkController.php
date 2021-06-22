<?php

namespace App\Http\Controllers;

use App\Models\GuruBk;
use Illuminate\Http\Request;

class GuruBkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guruBk = GuruBk::all();
        return view('gurubk.index',compact('guruBk'));
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
            'nip'=>'required|numeric',
            'name'=>'required|string',
        ]);
        GuruBk::create($request->all());
        return back()->with('alert-success', 'Guru BK berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GuruBk  $guruBk
     * @return \Illuminate\Http\Response
     */
    public function show(GuruBk $gurubk)
    {
        return response()->json($gurubk);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GuruBk  $guruBk
     * @return \Illuminate\Http\Response
     */
    public function edit(GuruBk $guruBk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GuruBk  $guruBk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuruBk $gurubk)
    {
        $request->validate([
            'nip'=>'required|numeric',
            'name'=>'required|string',
        ]);
        $is_active=$request->has('is_active')?1:0;
        $request=$request->all();
        $request['is_active']=$is_active;
        $gurubk->update($request);
        return back()->with('alert-success','Data Guru BK '.$request['name'].' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GuruBk  $guruBk
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuruBk $gurubk)
    {
        $oldName = $gurubk->delete();
        return back()->with('alert-success', 'Data Guru BK '.$oldName.' berhasil dihapus.');
    }
}

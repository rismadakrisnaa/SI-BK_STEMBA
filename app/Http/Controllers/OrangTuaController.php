<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrangTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function ajax()
    {
        $ortu=OrangTua::all();
        return request()->ajax()?response()->json($ortu):abort(403);
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
            'email'=>'required|email|unique:users,email',
            'name'=>'required'
        ]);
        $data=$request->except('_token','input');
        $data['user_id']=User::create([
            'email'=>$request->email,
            'name'=>$request->name,
            'password'=>Hash::make('passwordwali'),
            'role'=>'wali',
            'avatar'=>'/images/avatars/default.png'
        ])->_id;
        OrangTua::create($data);
        return $request->ajax()?response('Orang Tua Siswa berhasil ditambahkan'):redirect()->route('orang-tua.index')->with('alert-success','Orang Tua Siswa berhail ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrangTua  $orangTua
     * @return \Illuminate\Http\Response
     */
    public function show(OrangTua $orangTua)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrangTua  $orangTua
     * @return \Illuminate\Http\Response
     */
    public function edit(OrangTua $orangTua)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrangTua  $orangTua
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrangTua $orangTua)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrangTua  $orangTua
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrangTua $orangTua)
    {
        //
    }
}

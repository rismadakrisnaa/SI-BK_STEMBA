<?php

/**
 * Copyright Gosoftware Media 2021
 * --
 * Gosoftware Media
 * Site   : http://gosoftware.web.id
 * e-mail : cs@gosoftware.web.id
 * WA     : 62852-6361-6901
 * --
 */

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\GuruBk;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $role=['admin','siswa','guru','gurubk','wali','kepsek'];
        return view('user.create', compact('role'));
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
            'name' => 'bail|required|max:50',
            'email' => 'required|email|unique:users,email|unique:users|max:50',
            'role' => 'required|max:50',
            'password' => 'required|confirmed|max:50'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'avatar' => '/images/avatars/default.png',
            'password' => Hash::make($request->password)
        ]);

        switch($request->role){
            case 'guru':
                Guru::create([
                    'guru_nama'=>$request->name,
                    'email'=>$request->email,
                    'guru_aktif'=>1
                ]);
                break;
            case 'gurubk':
                GuruBk::create($request->only('name','email'));
                break;
            case 'siswa':
                Siswa::create([
                    'siswa_nama'=>$request->name,
                    'email'=>$request->email
                ]);
                break;
            case 'wali':
                OrangTua::create($request->only('name','email'));
                break;
            default:

        }

        $request->session()->flash('alert-success', 'Data berhasil disimpan!');
        return redirect('/dashboard/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = User::find($id);
        return view('user.show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = User::findOrFail($id);
        $role=['admin','guru','gurubk','siswa','wali','kepsek'];
        return view('user.edit', compact('row','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'bail|required|max:50',
            'email' => 'required|email|unique:users,email,'.$user->_id.',_id|max:50',
            'password' => 'nullable|confirmed|max:50'
        ]);


        if ($request->has('password')) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $request->session()->flash('alert-success', 'Data berhasil diperbarui dengan perubahan password!');
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            $request->session()->flash('alert-success', 'Data berhasil diperbarui tanpa perubahan password!');
        }

        return redirect('/dashboard/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $row = User::findOrFail($id);
        $row->delete();

        $request->session()->flash('alert-success', 'Data berhasil dihapus!');
        return redirect('/dashboard/user');
    }
}

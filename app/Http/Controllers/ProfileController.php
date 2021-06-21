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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $_id = Auth::id();
        $row = User::where('_id', $_id)->first();
        return view('profile', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|max:50',
            'email' => 'required|email|max:50',
            'password' => 'nullable|confirmed|max:50'
        ]);

        $id = Auth::id();
        $row = User::findOrFail($id);
        $any = User::where([['email', '=', $request->email], ['_id', '<>', $id]])->first();

        if ($row != null && $any === null) {
            if (!empty($request->password)) {
                $row->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
                $request->session()->flash('alert-success', 'Data berhasil diperbarui dengan perubahan password!');
            } else {
                $row->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
                $request->session()->flash('alert-success', 'Data berhasil diperbarui tanpa perubahan password!');
            }
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }

        return redirect('/dashboard/profile');
    }

}

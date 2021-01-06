<?php

namespace App\Http\Controllers;

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
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|confirmed|max:50'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

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
        return view('user.edit', compact('row'));
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
        $request->validate([
            'name' => 'bail|required|max:50',
            'email' => 'required|email|max:50',
            'password' => 'nullable|confirmed|max:50'
        ]);

        $row = User::findOrFail($id);
        $any = User::where([
            ['email', '=', $request->email],
            ['_id', '<>', $id]
        ])->first();

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

<?php

namespace App\Http\Controllers;

use App\Models\GuruBk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function ajax()
    {
        $guruBk=GuruBk::all();
        return request()->ajax()?response()->json($guruBk):abort(403);
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
                'nim'=>'required|numeric',
                'name'=>'required|string',
                'email'=>'required|email|unique:users,email'
            ],
            [
                'email.unique'=>'Email sudah pernah digunakan'
            ]
        );
        $data = $request->all();
        $data['user_id']=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make('passwordgurubk'),
            'role'=>'gurubk',
            'avatar'=>'/images/avatars/default.png'
        ])->_id;
        GuruBk::create($data);
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
                'nip'=>'sometimes|numeric',
                'name'=>'required|string',
                'email'=>'required|email|unique:users,email,'.$gurubk->user_id.',_id'
            ],
            [
                'email.unique'=>'Email sudah pernah digunakan'
            ]
        );
        $is_active=$request->has('is_active')?1:0;
        $user = User::find($gurubk->user_id);
        $user->update([
            'name'  => $request->guru_nama,
            'email' => $request->email,
        ]);
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
        $user=User::find($gurubk->user_id);
        if($user->avatar!='/images/avatars/default.png'){
            unlink($user->avatar);
        }
        $user->delete();
        $oldName = $gurubk->name;
        $gurubk->delete();
        return back()->with('alert-success', 'Data Guru BK '.$oldName.' berhasil dihapus.');
    }
}

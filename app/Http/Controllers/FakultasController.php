<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fakultas;

class FakultasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fakultas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'fak_kode' => 'bail|required|unique:col_fakultas,fak_kode',
                'fak_nama' => 'required'
            ],
            [
                'fak_kode.required' => 'Kode Wajib Diisi',
                'fak_nama.required' => 'Nama Wajib Diisi'
            ]
        );

        $aktif = 1;

        Fakultas::firstOrCreate(
            ['fak_kode' => $request->fak_kode],
            [
                'fak_nama' => $request->fak_nama,
                'fak_aktif' => $aktif
            ]
        );

        $request->session()->flash('alert-success', 'Data berhasil disimpan!');
        return redirect('/dashboard/fakultas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Fakultas::find($id);
        return view('fakultas.show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Fakultas::findOrFail($id);
        return view('fakultas.edit', compact('row'));
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
        $request->validate(
            [
                'fak_kode' => 'required',
                'fak_nama' => 'required'
            ],
            [
                'fak_kode.required' => 'Kode Wajib Diisi',
                'fak_nama.required' => 'Nama Wajib Diisi'
            ]
        );

        $row = Fakultas::findOrFail($id);
        $any = Fakultas::where([['fak_kode', '=', $request->fak_kode], ['_id', '<>', $id]])->first();
        $aktif = intval($request->fak_aktif);

        if ($row != null && $any === null) {
            $row->update([
                'fak_kode' => $request->fak_kode,
                'fak_nama' => $request->fak_nama,
                'fak_aktif' => $aktif
            ]);
            $request->session()->flash('alert-success', 'Data berhasil diperbarui!');
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }

        return redirect('/dashboard/fakultas');
    }
}

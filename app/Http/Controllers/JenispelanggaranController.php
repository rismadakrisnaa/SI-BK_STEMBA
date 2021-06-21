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
use App\Models\Jenispelanggaran;

class JenispelanggaranController extends Controller
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
        return view('jenispelanggaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenispelanggaran.create');
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
                'jenispelanggaran_kode' => 'bail|required|unique:col_jenispelanggaran,jenispelanggaran_kode',
                'jenispelanggaran_nama' => 'required',
                'jenispelanggaran_poin' => 'required'
            ],
            [
                'jenispelanggaran_kode.required' => 'Kode Wajib Diisi',
                'jenispelanggaran_nama.required' => 'Nama Wajib Diisi',
                'jenispelanggaran_poin.required' => 'Poin Wajib Diisi'
            ]
        );

        $aktif = 1;

        Jenispelanggaran::firstOrCreate(
            ['jenispelanggaran_kode' => $request->jenispelanggaran_kode],
            [
                'jenispelanggaran_nama' => $request->jenispelanggaran_nama,
                'jenispelanggaran_poin' => $request->jenispelanggaran_poin,
                'jenispelanggaran_aktif' => $aktif
            ]
        );

        $request->session()->flash('alert-success', 'Data berhasil disimpan!');
        return redirect('/dashboard/jenispelanggaran');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Jenispelanggaran::find($id);
        return view('jenispelanggaran.show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Jenispelanggaran::findOrFail($id);
        return view('jenispelanggaran.edit', compact('row'));
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
                'jenispelanggaran_kode' => 'required',
                'jenispelanggaran_nama' => 'required',
                'jenispelanggaran_poin' => 'required'
            ],
            [
                'jenispelanggaran_kode.required' => 'Kode Wajib Diisi',
                'jenispelanggaran_nama.required' => 'Nama Wajib Diisi',
                'jenispelanggaran_poin.required' => 'Poin Wajib Diisi'
            ]
        );

        $row = Jenispelanggaran::findOrFail($id);
        $any = Jenispelanggaran::where([['jenispelanggaran_kode', '=', $request->jenispelanggaran_kode], ['_id', '<>', $id]])->first();
        $aktif = intval($request->jenispelanggaran_aktif);

        if ($row != null && $any === null) {
            $row->update([
                'jenispelanggaran_kode' => $request->jenispelanggaran_kode,
                'jenispelanggaran_nama' => $request->jenispelanggaran_nama,
                'jenispelanggaran_poin' => $request->jenispelanggaran_poin,
                'jenispelanggaran_aktif' => $aktif
            ]);
            $request->session()->flash('alert-success', 'Data berhasil diperbarui!');
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }

        return redirect('/dashboard/jenispelanggaran');
    }
}

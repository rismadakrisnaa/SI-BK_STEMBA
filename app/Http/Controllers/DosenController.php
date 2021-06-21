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
use App\Models\Prodi;
use App\Models\Dosen;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dosen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $col_prodi = Prodi::where('prodi_aktif', 1)->orderBy('prodi_nama')->get();
        return view('dosen.create', compact('col_prodi'));
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
                'dsn_nidn' => 'required|unique:col_dosen,dsn_nidn',
                'dsn_nama' => 'required',
                'prodi_kode' => 'required'
            ],
            [
                'dsn_nidn.required' => 'Nomor Induk Dosen Nasional Wajib Diisi',
                'dsn_nama.required' => 'Nama Dosen Wajib Diisi',
                'prodi_kode.required' => 'Program Studi wajib dipilih',
            ]
        );

        $col_prodi = Prodi::where('prodi_kode', $request->prodi_kode)->first();
        $aktif = 1;

        Dosen::firstOrCreate(
            ['dsn_nidn' => $request->dsn_nidn],
            [
                'dsn_nip' => $request->dsn_nip,
                'dsn_nama' => $request->dsn_nama,
                'dsn_gelar_depan' => $request->dsn_gelar_depan,
                'dsn_gelar_belakang' => $request->dsn_gelar_belakang,
                'dsn_aktif' => $aktif,
                'prodi' => ['prodi_kode' => $col_prodi->prodi_kode, 'prodi_nama' => $col_prodi->prodi_nama],
                'fakultas' => ['fak_kode' => $col_prodi->fakultas['fak_kode'], 'fak_nama' => $col_prodi->fakultas['fak_nama']]
            ]
        );

        $request->session()->flash('alert-success', 'Data berhasil disimpan!');
        return redirect('/dashboard/dosen');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Dosen::find($id);
        return view('dosen.show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Dosen::find($id);
        $col_prodi = Prodi::where('prodi_aktif', 1)->orderBy('prodi_nama')->get();
        return view('dosen.edit', compact('row', 'col_prodi'));
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
                'dsn_nidn' => 'required',
                'dsn_nama' => 'required',
                'prodi_kode' => 'required'
            ],
            [
                'dsn_nidn.required' => 'Nomor Induk Dosen Nasional Wajib Diisi',
                'dsn_nama.required' => 'Nama Dosen Wajib Diisi',
                'prodi_kode.required' => 'Program Studi wajib dipilih',
            ]
        );
            
        $row = Dosen::findOrFail($id);
        $any = Dosen::where([['dsn_nidn', '=', $request->dsn_nidn], ['_id', '<>', $id]])->first();
        $col_prodi = Prodi::where('prodi_kode', $request->prodi_kode)->first();
        $aktif = intval($request->dsn_aktif);

        if ($row != null && $any === null) {
            $row->update([
                'dsn_nip' => $request->dsn_nip,
                'dsn_nidn' => $request->dsn_nidn,
                'dsn_nama' => $request->dsn_nama,
                'dsn_gelar_depan' => $request->dsn_gelar_depan,
                'dsn_gelar_belakang' => $request->dsn_gelar_belakang,
                'dsn_aktif' => $aktif,
                'prodi' => ['prodi_kode' => $col_prodi->prodi_kode, 'prodi_nama' => $col_prodi->prodi_nama],
                'fakultas' => ['fak_kode' => $col_prodi->fakultas['fak_kode'], 'fak_nama' => $col_prodi->fakultas['fak_nama']]
            ]);
            $request->session()->flash('alert-success', 'Data berhasil diperbarui!');
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }

        return redirect('/dashboard/dosen');
    }

}

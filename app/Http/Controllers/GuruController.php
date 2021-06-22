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
use App\Models\Guru;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guru.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('guru.create');
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
                'guru_nidn' => 'required|unique:col_guru,guru_nidn',
                'guru_nama' => 'required',
                'kelasjurusan_kode' => 'sometimes'
            ],
            [
                'guru_nidn.required' => 'Nomor Induk Guru Nasional Wajib Diisi',
                'guru_nama.required' => 'Nama Guru Wajib Diisi',
            ]
        );

        $aktif = 1;

        Guru::firstOrCreate(
            ['guru_nidn' => $request->guru_nidn],
            [
                'guru_nip' => $request->guru_nip,
                'guru_nama' => $request->guru_nama,
                'guru_gelar_depan' => $request->guru_gelar_depan,
                'guru_gelar_belakang' => $request->guru_gelar_belakang,
                'guru_aktif' => $aktif,
                // 'kelasjurusan' => ['kelasjurusan_kode' => $col_kelasjurusan->kelasjurusan_kode, 'kelasjurusan_nama' => $col_kelasjurusan->kelasjurusan_nama],
                // 'jenispelanggaran' => ['jenispelanggaran_kode' => $col_kelasjurusan->jenispelanggaran['jenispelanggaran_kode'], 'jenispelanggaran_nama' => $col_kelasjurusan->jenispelanggaran['jenispelanggaran_nama']]
            ]
        );

        $request->session()->flash('alert-success', 'Data berhasil disimpan!');
        return redirect('/dashboard/guru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Guru::find($id);
        return view('guru.show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Guru::find($id);
        // $col_kelasjurusan = Kelasjurusan::where('kelasjurusan_aktif', 1)->orderBy('kelasjurusan_nama')->get();
        return view('guru.edit', compact('row'));
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
                'guru_nidn' => 'required',
                'guru_nama' => 'required',
                // 'kelasjurusan_kode' => 'required'
            ],
            [
                'guru_nidn.required' => 'Nomor Induk Guru Nasional Wajib Diisi',
                'guru_nama.required' => 'Nama Guru Wajib Diisi',
                // 'kelasjurusan_kode.required' => 'Program Studi wajib dipilih',
            ]
        );
            
        $row = Guru::findOrFail($id);
        $any = Guru::where([['guru_nidn', '=', $request->guru_nidn], ['_id', '<>', $id]])->first();
        // $col_kelasjurusan = Kelasjurusan::where('kelasjurusan_kode', $request->kelasjurusan_kode)->first();
        $aktif = intval($request->guru_aktif);

        if ($row != null && $any === null) {
            $row->update([
                'guru_nip' => $request->guru_nip,
                'guru_nidn' => $request->guru_nidn,
                'guru_nama' => $request->guru_nama,
                'guru_gelar_depan' => $request->guru_gelar_depan,
                'guru_gelar_belakang' => $request->guru_gelar_belakang,
                'guru_aktif' => $aktif,
                // 'kelasjurusan' => ['kelasjurusan_kode' => $col_kelasjurusan->kelasjurusan_kode, 'kelasjurusan_nama' => $col_kelasjurusan->kelasjurusan_nama],
                // 'jenispelanggaran' => ['jenispelanggaran_kode' => $col_kelasjurusan->jenispelanggaran['jenispelanggaran_kode'], 'jenispelanggaran_nama' => $col_kelasjurusan->jenispelanggaran['jenispelanggaran_nama']]
            ]);
            $request->session()->flash('alert-success', 'Data berhasil diperbarui!');
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }

        return redirect('/dashboard/guru');
    }

}

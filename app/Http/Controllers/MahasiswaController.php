<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Dosen;

class MahasiswaController extends Controller
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
        return view('mahasiswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $col_prodi = Prodi::where('prodi_aktif', 1)->orderBy('prodi_nama')->get();
        $col_dosen = Dosen::where('dsn_aktif', 1)->orderBy('dsn_nama')->get();
        return view('mahasiswa.create', compact('col_prodi', 'col_dosen'));
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
                'mhsw_nim' => 'bail|required|unique:col_mhsw,mhsw_nim',
                'mhsw_nama' => 'required',
                'prodi_kode' => 'required',
                'dsn_nidn' => 'required'
            ],
            [
                'mhsw_nim.required' => 'NIM Wajib Diisi',
                'mhsw_nama.required' => 'Nama Wajib Diisi',
                'prodi_kode.required' => 'Program Studi wajib dipilih',
                'dsn_nidn.required' => 'Pembimbing Akademik wajib dipilih'
            ]
        );

        $col_prodi = Prodi::where('prodi_kode', $request->prodi_kode)->first();
        $col_dosen = Dosen::where('dsn_nidn', $request->dsn_nidn)->first();
        $aktif = 1;

        Mahasiswa::firstOrCreate(
            ['mhsw_nim' => $request->mhsw_nim],
            [
                'mhsw_nama' => $request->mhsw_nama,
                'mhsw_jk' => $request->mhsw_jk,
                'mhsw_tmplahir' => $request->mhsw_tmplahir,
                'mhsw_tgllahir' => $request->mhsw_tgllahir,
                'mhsw_alamat' => $request->mhsw_alamat,
                'mhsw_hp' => $request->mhsw_hp,
                'mhsw_aktif' => $aktif,
                'prodi' => ['prodi_kode' => $col_prodi->prodi_kode, 'prodi_nama' => $col_prodi->prodi_nama],
                'dosen' => [
                    'dsn_nidn' => $col_dosen->dsn_nidn, 
                    'dsn_nama' => $col_dosen->dsn_nama,
                    'dsn_gelar_depan' => $col_dosen->dsn_gelar_depan,
                    'dsn_gelar_belakang' => $col_dosen->dsn_gelar_belakang,
                    ]
            ]
        );

        $request->session()->flash('alert-success', 'Data berhasil disimpan!');
        return redirect('/dashboard/mahasiswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Mahasiswa::find($id);
        return view('mahasiswa.show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Mahasiswa::findOrFail($id);
        $col_prodi = Prodi::where('prodi_aktif', 1)->orderBy('prodi_nama')->get();
        $col_dosen = Dosen::where('dsn_aktif', 1)->orderBy('dsn_nama')->get();
        return view('mahasiswa.edit', compact('row', 'col_prodi', 'col_dosen'));
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
                'mhsw_nim' => 'required',
                'mhsw_nama' => 'required',
                'prodi_kode' => 'required',
                'dsn_nidn' => 'required'
            ],
            [
                'mhsw_nim.required' => 'NIM Wajib Diisi',
                'mhsw_nama.required' => 'Nama Wajib Diisi',
                'prodi_kode.required' => 'Program Studi wajib dipilih',
                'dsn_nidn.required' => 'Pembimbing Akademik wajib dipilih'
            ]
        );

        $row = Mahasiswa::findOrFail($id);
        $any = Mahasiswa::where([['mhsw_nim', '=', $request->mhsw_nim], ['_id', '<>', $id]])->first();
        $col_prodi = Prodi::where('prodi_kode', $request->prodi_kode)->first();
        $col_dosen = Dosen::where('dsn_nidn', $request->dsn_nidn)->first();
        $aktif = intval($request->mhsw_aktif);

        if ($row != null && $any === null) {
            $row->update([
                'mhsw_nim' => $request->mhsw_nim,
                'mhsw_nama' => $request->mhsw_nama,
                'mhsw_jk' => $request->mhsw_jk,
                'mhsw_tmplahir' => $request->mhsw_tmplahir,
                'mhsw_tgllahir' => $request->mhsw_tgllahir,
                'mhsw_alamat' => $request->mhsw_alamat,
                'mhsw_hp' => $request->mhsw_hp,
                'mhsw_aktif' => $aktif,
                'prodi' => ['prodi_kode' => $col_prodi->prodi_kode, 'prodi_nama' => $col_prodi->prodi_nama],
                'dosen' => [
                    'dsn_nidn' => $col_dosen->dsn_nidn, 
                    'dsn_nama' => $col_dosen->dsn_nama,
                    'dsn_gelar_depan' => $col_dosen->dsn_gelar_depan,
                    'dsn_gelar_belakang' => $col_dosen->dsn_gelar_belakang,
                    ]
            ]);
            $request->session()->flash('alert-success', 'Data berhasil diperbarui!');
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }

        return redirect('/dashboard/mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $row = Mahasiswa::findOrFail($id);
        $row->delete();

        $request->session()->flash('alert-success', 'Data berhasil dihapus!');
        return redirect('/dashboard/mahasiswa');
    }
}

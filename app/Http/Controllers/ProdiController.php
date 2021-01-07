<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fakultas;
use App\Models\Prodi;

class ProdiController extends Controller
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
        return view('prodi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $col_fakultas = Fakultas::where('fak_aktif', 1)->orderBy('fak_kode')->get();
        return view('prodi.create', compact('col_fakultas'));
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
                'fak_kode' => 'required',
                'prodi_kode' => 'bail|required|unique:col_prodi,prodi_kode',
                'prodi_nama' => 'required'
            ],
            [
                'fak_kode.required' => 'Fakultas wajib dipilih',
                'prodi_kode.required' => 'Kode Program Studi Wajib Diisi',
                'prodi_nama.required' => 'Nama Program Studi Wajib Diisi'
            ]
        );

        $col_fakultas = Fakultas::where('fak_kode', $request->fak_kode)->first();
        $aktif = 1;

        Prodi::firstOrCreate(
            ['prodi_kode' => $request->prodi_kode],
            [
                'fakultas' => ['fak_kode' => $col_fakultas->fak_kode, 'fak_nama' => $col_fakultas->fak_nama],
                'prodi_kode' => $request->prodi_kode,
                'prodi_nama' => $request->prodi_nama,
                'prodi_akreditasi' => $request->prodi_akreditasi,
                'prodi_aktif' => $aktif
            ]
        );

        $request->session()->flash('alert-success', 'Data berhasil disimpan!');
        return redirect('/dashboard/prodi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Prodi::find($id);
        return view('prodi.show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Prodi::find($id);
        $col_fakultas = Fakultas::where('fak_aktif', 1)->orderBy('fak_kode')->get();
        return view('prodi.edit', compact('row', 'col_fakultas'));
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
                'prodi_kode' => 'required',
                'prodi_nama' => 'required'
            ],
            [
                'fak_kode.required' => 'Fakultas wajib dipilih',
                'prodi_kode.required' => 'Kode Program Studi Wajib Diisi',
                'prodi_nama.required' => 'Nama Program Studi Wajib Diisi'
            ]
        );
     
        $row = Prodi::findOrFail($id);
        $any = Prodi::where([['prodi_kode', '=', $request->prodi_kode], ['_id', '<>', $id]])->first();
        $col_fakultas = Fakultas::where('fak_kode', $request->fak_kode)->first();
        $aktif = intval($request->prodi_aktif);

        if ($row != null && $any === null) {
            $row->update([
                'fakultas' => ['fak_kode' => $col_fakultas->fak_kode, 'fak_nama' => $col_fakultas->fak_nama],
                'prodi_kode' => $request->prodi_kode,
                'prodi_nama' => $request->prodi_nama,
                'prodi_akreditasi' => $request->prodi_akreditasi,
                'prodi_aktif' => $aktif
            ]);
            $request->session()->flash('alert-success', 'Data berhasil diperbarui!');
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }

        return redirect('/dashboard/prodi');
    }

}

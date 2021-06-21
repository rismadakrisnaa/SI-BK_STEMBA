<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelasjurusan;
use App\Models\Guru;

class SiswaController extends Controller
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
        return view('siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $col_kelasjurusan = Kelasjurusan::where('kelasjurusan_aktif', 1)->orderBy('kelasjurusan_nama')->get();
        $col_guru = Guru::where('guru_aktif', 1)->orderBy('guru_nama')->get();
        return view('siswa.create', compact('col_kelasjurusan', 'col_guru'));
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
                'siswa_nim' => 'bail|required|unique:col_siswa,siswa_nim',
                'siswa_nama' => 'required',
                'kelasjurusan_kode' => 'required',
                'guru_nidn' => 'required'
            ],
            [
                'siswa_nim.required' => 'NIM Wajib Diisi',
                'siswa_nama.required' => 'Nama Wajib Diisi',
                'kelasjurusan_kode.required' => 'Program Studi wajib dipilih',
                'guru_nidn.required' => 'Pembimbing Akademik wajib dipilih'
            ]
        );

        $col_kelasjurusan = Kelasjurusan::where('kelasjurusan_kode', $request->kelasjurusan_kode)->first();
        $col_guru = Guru::where('guru_nidn', $request->guru_nidn)->first();
     
        $aktif = 1;

        Siswa::firstOrCreate(
            ['siswa_nim' => $request->siswa_nim],
            [
                'siswa_nama' => $request->siswa_nama,
                'siswa_jk' => $request->siswa_jk,
                'siswa_tmplahir' => $request->siswa_tmplahir,
                'siswa_tgllahir' => $request->siswa_tgllahir,
                'siswa_alamat' => $request->siswa_alamat,
                'siswa_hp' => $request->siswa_hp,
                'siswa_aktif' => $aktif,
                'kelasjurusan' => ['kelasjurusan_kode' => $col_kelasjurusan->kelasjurusan_kode, 'kelasjurusan_nama' => $col_kelasjurusan->kelasjurusan_nama],
                'guru' => [
                    'guru_nidn' => $col_guru->guru_nidn, 
                    'guru_nama' => $col_guru->guru_nama,
                    'guru_gelar_depan' => $col_guru->guru_gelar_depan,
                    'guru_gelar_belakang' => $col_guru->guru_gelar_belakang,
                ]
            ]
        );

        $request->session()->flash('alert-success', 'Data berhasil disimpan!');
        return redirect('/dashboard/siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Siswa::find($id);
        return view('siswa.show', compact('row'));
    }
    
    //public function search(Request $request)
    //{
      //  $cari = $request->get('$cari');
        //$col_siswa = Siswa:: all();

        //if($request->has('cari')){
          //  $col_siswa = Siswa::where('siswa_nama','LIKE',"%".$request->cari."%")->get();
        
        //}
        //return view ('siswa.show',compact('col_siswa'))

    //}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Siswa::findOrFail($id);
        $col_kelasjurusan = Kelasjurusan::where('kelasjurusan_aktif', 1)->orderBy('kelasjurusan_nama')->get();
        $col_guru = Guru::where('guru_aktif', 1)->orderBy('guru_nama')->get();
        return view('siswa.edit', compact('row', 'col_kelasjurusan', 'col_guru'));
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
                'siswa_nim' => 'required',
                'siswa_nama' => 'required',
                'kelasjurusan_kode' => 'required',
                'guru_nidn' => 'required'
            ],
            [
                'siswa_nim.required' => 'NIM Wajib Diisi',
                'siswa_nama.required' => 'Nama Wajib Diisi',
                'kelasjurusan_kode.required' => 'Program Studi wajib dipilih',
                'guru_nidn.required' => 'Pembimbing Akademik wajib dipilih'
            ]
            
        );

        $row = Siswa::findOrFail($id);
        $any = Siswa::where([['siswa_nim', '=', $request->siswa_nim], ['_id', '<>', $id]])->first();
        $col_kelasjurusan = Kelasjurusan::where('kelasjurusan_kode', $request->kelasjurusan_kode)->first();
        $col_guru = Guru::where('guru_nidn', $request->guru_nidn)->first();
        $aktif = intval($request->siswa_aktif);

        if ($row != null && $any === null) {
            $row->update([
                'siswa_nim' => $request->siswa_nim,
                'siswa_nama' => $request->siswa_nama,
                'siswa_jk' => $request->siswa_jk,
                'siswa_tmplahir' => $request->siswa_tmplahir,
                'siswa_tgllahir' => $request->siswa_tgllahir,
                'siswa_alamat' => $request->siswa_alamat,
                'siswa_hp' => $request->siswa_hp,
                'siswa_aktif' => $aktif,
                'kelasjurusan' => ['kelasjurusan_kode' => $col_kelasjurusan->kelasjurusan_kode, 'kelasjurusan_nama' => $col_kelasjurusan->kelasjurusan_nama],
                'guru' => [
                    'guru_nidn' => $col_guru->guru_nidn, 
                    'guru_nama' => $col_guru->guru_nama,
                    'guru_gelar_depan' => $col_guru->guru_gelar_depan,
                    'guru_gelar_belakang' => $col_guru->guru_gelar_belakang,
                ]
            ]);
            $request->session()->flash('alert-success', 'Data berhasil diperbarui!');
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }

        return redirect('/dashboard/siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $row = Siswa::findOrFail($id);
        $row->delete();

        $request->session()->flash('alert-success', 'Data berhasil dihapus!');
        return redirect('/dashboard/siswa');
    }

    
}

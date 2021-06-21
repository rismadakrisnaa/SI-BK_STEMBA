<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Kelasjurusan;

class KelasjurusanController extends Controller
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
        return view('kelasjurusan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $col_guru = Guru::where('guru_aktif', 1)->orderBy('guru_nip')->get();
        return view('kelasjurusan.create', compact('col_guru'));
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
                'guru_nip' => 'required',
                'kelasjurusan_kode' => 'bail|required|unique:col_kelasjurusan,kelasjurusan_kode',
                'kelasjurusan_nama' => 'required'
            ],
            [
                'guru_nip.required' => 'Wali Kelas wajib dipilih',
                'kelasjurusan_kode.required' => 'Kode Program Studi Wajib Diisi',
                'kelasjurusan_nama.required' => 'Nama Program Studi Wajib Diisi'
            ]
        );

        $col_guru = Guru::where('guru_nip', $request->guru_nip)->first();
        $aktif = 1;

        Kelasjurusan::firstOrCreate(
            ['kelasjurusan_kode' => $request->kelasjurusan_kode],
            [
                'guru' => ['guru_nip' => $col_guru->guru_nip, 'guru_nama' => $col_guru->guru_nama],
                'kelasjurusan_kode' => $request->kelasjurusan_kode,
                'kelasjurusan_nama' => $request->kelasjurusan_nama,
                'kelasjurusan_aktif' => $aktif
            ]
        );

        $request->session()->flash('alert-success', 'Data berhasil disimpan!');
        return redirect('/dashboard/kelasjurusan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Kelasjurusan::find($id);
        return view('kelasjurusan.show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Kelasjurusan::find($id);
        $col_guru = Guru::where('guru_aktif', 1)->orderBy('guru_nip')->get();
        return view('kelasjurusan.edit', compact('row', 'col_guru'));
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
                'guru_nip' => 'required',
                'kelasjurusan_kode' => 'required',
                'kelasjurusan_nama' => 'required'
            ],
            [
                'guru_nip.required' => 'Wali Kelas wajib dipilih',
                'kelasjurusan_kode.required' => 'Kode Program Studi Wajib Diisi',
                'kelasjurusan_nama.required' => 'Nama Program Studi Wajib Diisi'
            ]
        );
     
        $row = Kelasjurusan::findOrFail($id);
        $any = Kelasjurusan::where([['kelasjurusan_kode', '=', $request->kelasjurusan_kode], ['_id', '<>', $id]])->first();
        $col_guru = Guru::where('guru_nip', $request->guru_nip)->first();
        $aktif = intval($request->kelasjurusan_aktif);

        if ($row != null && $any === null) {
            $row->update([
                'guru' => ['guru_nip' => $col_guru->guru_nip, 'guru_nama' => $col_guru->guru_nama],
                'kelasjurusan_kode' => $request->kelasjurusan_kode,
                'kelasjurusan_nama' => $request->kelasjurusan_nama,
                'kelasjurusan_aktif' => $aktif
            ]);
            $request->session()->flash('alert-success', 'Data berhasil diperbarui!');
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }

        return redirect('/dashboard/kelasjurusan');
    }

}
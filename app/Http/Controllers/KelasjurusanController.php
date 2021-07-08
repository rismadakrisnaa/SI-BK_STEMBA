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

    public function ajax()
    {
        return request()->ajax()?response()->json(Kelasjurusan::all()):abort(403, 'permintaan harus ajax');
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
                'guru_id' => 'required',
                'kelasjurusan_kode' => 'bail|required|unique:col_kelasjurusan,kelasjurusan_kode',
                'kelasjurusan_nama' => 'required'
            ],
            [
                'guru_id.required' => 'Wali Kelas wajib dipilih',
                'kelasjurusan_kode.required' => 'Kode Program Studi Wajib Diisi',
                'kelasjurusan_nama.required' => 'Nama Program Studi Wajib Diisi'
            ]
        );

        $aktif = 1;

        Kelasjurusan::firstOrCreate(
            ['kelasjurusan_kode' => $request->kelasjurusan_kode],
            [
                'guru_id' => $request->guru_id,
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
        $row->siswa;
        return request()->ajax()?response()->json($row):view('kelasjurusan.show', compact('row'));
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
                'guru_id' => 'required',
                'kelasjurusan_kode' => 'required',
                'kelasjurusan_nama' => 'required'
            ],
            [
                'guru_id.required' => 'Wali Kelas wajib dipilih',
                'kelasjurusan_kode.required' => 'Kode Program Studi Wajib Diisi',
                'kelasjurusan_nama.required' => 'Nama Program Studi Wajib Diisi'
            ]
        );

        $row = Kelasjurusan::findOrFail($id);
        $any = Kelasjurusan::where([['kelasjurusan_kode', '=', $request->kelasjurusan_kode], ['_id', '<>', $id]])->first();

        if ($row != null && $any === null) {
            $row->update($request->except('_token','_method','input'));
            $request->session()->flash('alert-success', 'Data berhasil diperbarui!');
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }

        return redirect('/dashboard/kelasjurusan');
    }

    public function destroy($kelasjurusan)
    {
        Kelasjurusan::find($kelasjurusan)->delete();
        return back()->with('alert-success','Data Kelas berhasil dihapus!');
    }

}

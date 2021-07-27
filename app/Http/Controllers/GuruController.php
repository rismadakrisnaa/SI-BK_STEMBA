<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\GuruBk;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Imports\GuruImport;
use App\Imports\GuruImport as ImportsGuruImport;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allGuru=Guru::all();
        return view('guru.index',compact('allGuru'));
    }

    public function import()
    {
        return view('import');
    }

    public function storeImport(Request $request)
    {
        // dd($request);
        Excel::import(new ImportsGuruImport, $request->file('guruexcel'));
        
        return redirect()->back();
    }

    public function ajax()
    {
        $guruBk=GuruBk::all();
        $waliKelas=Guru::all();
        foreach($guruBk as $g){
            $dataGuru[]=['nip'=>$g->nim,'nama'=>$g->name];
        }
        foreach($waliKelas as $wk){
            $dataGuru[]=['nip'=>$wk->guru_nip,'nama'=>$wk->guru_nama];
        }
        return response()->json($dataGuru);
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
                'guru_nidn' => 'required|unique:guru,guru_nidn',
                'guru_nama' => 'required',
                'kelasjurusan_kode' => 'sometimes',
                'email'=>      'required|email|unique:users,email'
            ],
            [
                'guru_nidn.required' => 'Nomor Induk Guru Nasional Wajib Diisi',
                'guru_nama.required' => 'Nama Guru Wajib Diisi',
                'email.unique'       => 'Email Sudah Digunakan orang lain',
            ]
        );

        $data = $request->except('guru_nidn','input');
        $data['guru_aktif']=1;
        $data['user_id']=User::create([
            'email'=>$request->email,
            'name'=>$request->guru_nama,
            'password'=>Hash::make('passwordguru'),
            'role'=>'guru',
            'avatar'=>'/images/avatars/default.png'
        ])->id;

        Guru::firstOrCreate(
            ['guru_nidn' => $request->guru_nidn],
            $data
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
        $guru = Guru::find($id);
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
    {
        $request->validate(
            [
                'guru_nidn' => 'required',
                'guru_nama' => 'required',
                'email'     => 'required|email|unique:users,email,'.$guru->user_id.',_id'
            ],
            [
                'guru_nidn.required' => 'Nomor Induk Guru Nasional Wajib Diisi',
                'guru_nama.required' => 'Nama Guru Wajib Diisi',
                'email.unique'       => 'Email Sudah Digunakan orang lain',
            ]
        );

        $user = User::find($guru->user_id);
        $user->update([
            'name'  => $request->guru_nama,
            'email' => $request->email,
        ]);

        $data = $request->except('guru_nidn','input');
        $guru->update($data);

        return redirect('/dashboard/guru')->with('alert-success','Data Guru berhasil diperbarui!');
    }

    public function destroy(Guru $guru)
    {
        $user=User::find($guru->user_id);
        if($user->avatar!='/images/avatars/default.png'){
            unlink($user->avatar);
        }
        $user->delete();
        $guru->delete();
        return back()->with('alert-success', 'Guru berhasil dihapus.');
    }

}

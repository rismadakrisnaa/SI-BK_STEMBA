<?php



namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelasjurusan;
use App\Models\Guru;
use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

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
        $allSiswa=Siswa::latest()->get();
        $allSiswa=$allSiswa->filter(function($siswa){
            return Gate::allows('siswa-ku',$siswa);
        });
        return view('siswa.index',compact('allSiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelasjurusan::where('kelasjurusan_aktif', 1)->orderBy('kelasjurusan_nama')->get();
        $agama=['Islam','Kristen','Katolik','Hindu','Budha','Khonghucu','Lainya'];
        $pekerjaan='Tidak Bekerja,Nelayan,Petani,Peternak,PNS/TNI/POLRI,Karyawan Swasta,Pedagang Kecil,Pedagang Besar,Wiraswasta,Buruh,Pensiunan,Tenaga Kerja Indonesia,Tidak dapat diterapkan,Sudah Meninggoy,Lainya';
        $pekerjaan=explode(',',$pekerjaan);
        return view('siswa.create', compact('kelas','agama','pekerjaan'));
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
                'siswa_nis' => 'bail|required|unique:siswa,siswa_nis',
                'siswa_nisn' => 'bail|required|unique:siswa,siswa_nisn',
                'siswa_nama' => 'required',
                'kelas_id' => 'required',
                'email' => 'required|email|unique:users,email'
            ],
            [
                'siswa_nis.required' => 'NIS Wajib Diisi',
                'siswa_nisn.required' => 'NISN Wajib Diisi',
                'siswa_nama.required' => 'Nama Wajib Diisi',
                'kelas_id.required' => 'Program Studi wajib dipilih',
                'email.unique'     => 'Email ini sudah dipakai'
            ]
        );
        $fileName = 'default.png';
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $fileName = time().'.'.$avatar->getClientOriginalExtension();
            $avatar->move(public_path('/images/avatars/'),$fileName);
        }

        $data=$request->except('_token','input');
        $data['siswa_aktif']=1;
        $data['user_id']=User::create([
            'email'=>$request->email,
            'name'=>$request->siswa_nama,
            'password'=>Hash::make('passwordsiswa'),
            'role'=>'siswa',
            'avatar'=>'/images/avatars/'.$fileName
        ])->_id;

        Siswa::firstOrCreate(
            ['siswa_nis' => $request->siswa_nis],
            $data
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
        $row     = Siswa::find($id);
        $absensi = Absensi::where('siswa_id',$id)->get();
        return view('siswa.show', compact('row','absensi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        $kelas = Kelasjurusan::where('kelasjurusan_aktif', 1)->orderBy('kelasjurusan_nama')->get();
        $agama=['Islam','Kristen','Katolik','Hindu','Budha','Khonghucu','Lainya'];
        $pekerjaan='Tidak Bekerja,Nelayan,Petani,Peternak,PNS/TNI/POLRI,Karyawan Swasta,Pedagang Kecil,Pedagang Besar,Wiraswasta,Buruh,Pensiunan,Tenaga Kerja Indonesia,Tidak dapat diterapkan,Sudah Meninggoy,Lainya';
        $pekerjaan=explode(',',$pekerjaan);
        return view('siswa.edit', compact('siswa', 'kelas', 'agama', 'pekerjaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate(
            [
                'siswa_nis' => 'bail|required',
                'siswa_nisn' => 'bail|required',
                'siswa_nama' => 'required',
                'kelas_id' => 'required',
                'email' => 'bail|required|email|unique:users,email,'.$siswa->user_id.',_id'
            ],
            [
                'siswa_nis.required' => 'NIS Wajib Diisi',
                'siswa_nisn.required' => 'NISN Wajib Diisi',
                'siswa_nama.required' => 'Nama Wajib Diisi',
                'kelas_id.required' => 'Program Studi wajib dipilih',
                'email.unique'     => 'Email ini sudah dipakai'
            ]
        );

        $data=$request->except('_token','_method','input');
        $user=User::find($siswa->user_id);
        if($request->hasFile('avatar')){
            $avatar=$request->file('avatar');
            if($user->avatar!='/images/avatars/default.png'){
                unlink($user->avatar);
            }
            $fileName=time().'.'.$avatar->getClientOriginalExtension();
            $avatar->move(public_path('/images/avatars/'),$fileName);
            $user->update(['avatar'=>'/images/avatars/'.$fileName]);
        }
        $user->update([
            'email'=>$request->email,
            'name'=>$request->siswa_nama
        ]);

        $siswa->update($data);

        return redirect('/dashboard/siswa')->with('alert-success','Siswa berhasil diperbarui.');
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
        $user=User::find($row->user_id);
        if($user->avatar!='/images/avatars/default.png'){
            if(file_exists($user->avatar)){
                unlink($user->avatar);
            }
        }
        $user->delete();
        $row->delete();

        $request->session()->flash('alert-success', 'Data berhasil dihapus!');
        return redirect('/dashboard/siswa');
    }


}

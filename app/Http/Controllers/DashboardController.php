<?php



namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\PelanggaranSiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PemesananJadwalKonseling;
use App\Models\Siswa;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('can:siswa', ['only'=>['index2']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        if(Gate::allows('admin')){
            $data['totaluser']=DB::table('users')->count();
            $data['totalsiswa']=DB::table('siswa')->count();
            $data['totalguru']=DB::table('guru')->count();
        }
        if(Gate::any(['admin','gurubk'])){
            $data['totalhomevisit']=DB::table('homevisit')->count();
            $data['totalpelanggaran']=DB::table('pelanggaran_siswa')->count();
            $data['totalpanggilan']=DB::table('panggilan_ortu')->count();
            $data['siswaKu']=Siswa::all();
            $data['totalkonseling']=DB::table('pemesanan_jadwal_konseling')->where('status','pending')->count();
        }


        $point = PelanggaranSiswa::max('_id');
        $data['point1'] = DB::table('pelanggaran_siswa')->where('_id',$point)->count();

        $panggilankonseling=PemesananJadwalKonseling ::max('_id');
        $data['panggilankonseling1']=DB::table('pemesanan_jadwal_konseling')->where('status','approve')->where('_id',$panggilankonseling)->count();

        if(Gate::allows('siswa')){
            $data['panggilanKonseling']=auth()->user()->siswa[0]->jadwalKonseling->count();
            $data['pointPelanggaran']=auth()->user()->siswa[0]->totalPoint(false);
            $data['absen']=auth()->user()->siswa[0]->absen;
        }

        if(Gate::allows('guru')){
            $data['siswaKu']=auth()->user()->guru[0]->siswa();
            $data['totalpelanggaran']=0;
            foreach($data['siswaKu'] as $siswa){
                $data['totalpelanggaran']+=$siswa->totalPoint(false);
            }
        }

        if(Gate::allows('wali')){
            $data['anakKu']=auth()->user()->wali[0]->siswa;
            $data['pointPelanggaran']=0;
            $data['absenAnakKu']=['a'=>0,'s'=>0,'i'=>0,'h'=>0];
            foreach($data['anakKu'] as $anak){
                $data['pointPelanggaran']+=$anak->totalPoint(false);
                $data['absenAnakKu']['a']+=$anak->absen->where('absen', 'a')->count();
                $data['absenAnakKu']['s']+=$anak->absen->where('absen', 's')->count();
                $data['absenAnakKu']['i']+=$anak->absen->where('absen', 'i')->count();
                $data['absenAnakKu']['h']+=$anak->absen->where('absen', 'h')->count();
            }
        }



        return view('dashboard', $data);
    }


}

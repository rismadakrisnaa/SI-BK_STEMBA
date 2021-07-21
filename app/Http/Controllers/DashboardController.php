<?php



namespace App\Http\Controllers;

use App\Models\PelanggaranSiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PemesananJadwalKonseling;
use Illuminate\Auth\Access\Gate;

class DashboardController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can:siswa', ['only'=>['index2']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $totaluser=DB::table('users')->count();
        $totalsiswa=DB::table('siswa')->count();
        $totalhomevisit=DB::table('homevisit')->count();
        $totalpelanggaran=DB::table('pelanggaran_siswa')->count();
        $totalguru=DB::table('guru')->count();
        $totalpanggilan=DB::table('panggilan_ortu')->count();
        $totalkonseling=DB::table('pemesanan_jadwal_konseling')->where('status','pending')->count();

        
        $point = PelanggaranSiswa::max('_id');
        $point1 = DB::table('pelanggaran_siswa')->where('_id',$point)->count();

        $panggilankonseling=PemesananJadwalKonseling ::max('_id');
        $panggilankonseling1=DB::table('pemesanan_jadwal_konseling')->where('status','approve')->where('_id',$panggilankonseling)->count();
        
        


        return view('dashboard', compact('totaluser','totalsiswa','totalhomevisit',
        'totalpelanggaran','totalguru','totalpanggilan','totalkonseling', 'panggilankonseling1','point1'));
    }

    
}

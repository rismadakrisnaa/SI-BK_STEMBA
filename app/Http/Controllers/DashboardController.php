<?php



namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
        $totalkonseling=DB::table('pemesanan_jadwal_konseling')->count();
        return view('dashboard', compact('totaluser','totalsiswa','totalhomevisit',
        'totalpelanggaran','totalguru','totalpanggilan','totalkonseling'));
    }
}

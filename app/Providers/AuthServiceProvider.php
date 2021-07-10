<?php

namespace App\Providers;

use App\Models\Kelasjurusan;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin',function(){
            return auth()->user()->role=='admin';
        });

        Gate::define('guru',function(){
            return auth()->user()->role=='guru';
        });

        Gate::define('gurubk',function(){
            return auth()->user()->role=='gurubk';
        });

        Gate::define('siswa',function(){
            return auth()->user()->role=='siswa';
        });

        Gate::define('wali',function(){
            return auth()->user()->role=='wali';
        });

        Gate::define('kepsek',function(){
            return auth()->user()->role=='kepala sekolah';
        });

        Gate::define('kelas-ku',function(User $user, Kelasjurusan $kelas){
            if(auth()->user()->role=='admin'){
                return true;
            }
            return in_array($kelas->_id,auth()->user()->guru[0]->kelas->pluck('_id')->toArray());
        });

        Gate::define('siswa-ku',function(User $user, Siswa $siswa){
            if(auth()->user()->role=='admin'||auth()->user()->role=='gurubk'){
                return true;
            }
            return in_array($siswa->_id,auth()->user()->guru[0]->siswa()->pluck('_id')->toArray());
        });

        Gate::define('anak-ku',function(User $user, Siswa $siswa){
            if(Gate::allows('admin')||Gate::allows('gurubk')){
                return true;
            }
            return in_array($siswa->_id,auth()->user()->wali[0]->siswa()->pluck('_id')->toArray());
        });

    }
}

<?php

use App\Http\Controllers\AbsenesiController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\GuruBkController;
use App\Http\Controllers\PelaksanaanKonseling;
use App\Http\Controllers\PelaksanaanKonselingController;
use App\Http\Controllers\PemesananJadwalKonselingController;
use App\Http\Controllers\TimelineAkademikController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('dashboard')->middleware(['web', 'auth'])->group(function () {

    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index']);
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update']);
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update_avatar']);
    Route::resource('siswa', App\Http\Controllers\SiswaController::class);
    Route::resource('guru', App\Http\Controllers\GuruController::class);
    Route::resource('gurubk', App\Http\Controllers\GuruBkController::class);
    Route::resource('kelasjurusan', App\Http\Controllers\KelasjurusanController::class);
    Route::resource('jenispelanggaran', App\Http\Controllers\JenispelanggaranController::class);
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('absensi', AbsensiController::class);

    Route::resource('timeline-akademik', TimelineAkademikController::class);
    Route::post('timeline-akademik/post_media', [TimelineAkademikController::class, 'post_media']);

    // Konseling
    Route::resource('pemesanan-jadwal-konseling', PemesananJadwalKonselingController::class);
    Route::resource('pelaksanaan-konseling', PelaksanaanKonselingController::class);
    Route::get('hasil-konseling', [PelaksanaanKonselingController::class, 'hasil']);
    Route::put('hasil-konseling/cetak', [PelaksanaanKonselingController::class, 'cetak']);
});

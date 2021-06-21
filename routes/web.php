<?php

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
    // Route::resource('gurubk', App\Http\Controllers\GuruBKController::class)->except('destroy');
    Route::resource('kelasjurusan', App\Http\Controllers\KelasjurusanController::class);
    Route::resource('jenispelanggaran', App\Http\Controllers\JenispelanggaranController::class);
    Route::resource('user', App\Http\Controllers\UserController::class);

});

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
    Route::resource('mahasiswa', App\Http\Controllers\MahasiswaController::class);
    Route::resource('dosen', App\Http\Controllers\DosenController::class)->except('destroy');
    Route::resource('prodi', App\Http\Controllers\ProdiController::class)->except('destroy');
    Route::resource('fakultas', App\Http\Controllers\FakultasController::class)->except('destroy');
    Route::resource('user', App\Http\Controllers\UserController::class);

});

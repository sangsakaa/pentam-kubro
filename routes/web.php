<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\RombonganController;
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

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware(['auth']);
Route::get('/dashboard/{provinceCode}', [DashboardController::class, 'getKabupaten']);
Route::get('/dashboard/kecamatan/{kabupatenCode}', [DashboardController::class, 'getKecamatan']);
Route::post('/rombongan-kubro/kabupaten/kecamatan', [RombonganController::class, 'store']);
Route::get('/form-daftar/{provinceCode}', [RombonganController::class, 'getKabupaten']);

Route::get('/form-daftar', [RombonganController::class, 'create'])->name('form-daftar');
Route::get('/notifikasi/{kode_pendaftaran}', [RombonganController::class, 'Notif'])->name('notifikasi');
Route::get('/kartu-peserta-kubro/{kode_pendaftaran}', [RombonganController::class, 'LayoutKartu']);
Route::get('/cetak-kartu/{kode_pendaftaran}', [RombonganController::class, 'downloadKPK']);



// RESERVASI
Route::get('/reservasi', [ReservasiController::class, 'checkin']);
Route::post('/reservasi-qr', [ReservasiController::class, 'store']);
Route::get('/generate-reservasi-qr', [ReservasiController::class, 'generateQR']);
Route::get('/reservasi-kehadiran', [ReservasiController::class, 'index'])->name('reservasi-kehadiran');


require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::get('/sarpra/login', 'loginSarpra')->name('loginSarpra');
    Route::post('/sarpra/login/process', 'loginSarpraProcess')->name('loginSarpraProcess');
    Route::get('/register', 'register')->name('register');
    Route::post('/login/process', 'loginProcess')->name('loginProcess');
    Route::post('/register/process', 'registerProcess')->name('registerProcess');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware('isLogin')->group(function() {
    Route::controller(HomeController::class)->group(function() {
        Route::get('/tambah/step1', 'index')->name('home');
        Route::post('/tambah/step1/submit', 'store')->name('submit');
        Route::get('/tambah/step2/{peminjamanId}', 'index2')->name('home2');
        Route::post('/tambah/step2/{peminjamanId}/submit', 'store2')->name('store2');
        Route::get('/tambah/step3', 'index3')->name('home3');
    });
    Route::controller(RiwayatController::class)->group(function() {
        Route::get('/riwayat', 'index')->name('riwayat.index');
        Route::get('/sarpra/riwayat', 'indexSarpra')->name('sarpra.riwayat.index');
        Route::post('/pengajuan/{pengajuanId}/set-revisi', 'setRevisi')->name('pengajuan.setRevisi');
        Route::get('/pengajuan/{pengajuanId}/set-terima', 'setTerima')->name('pengajuan.setTerima');
        Route::get('/pengajuan/{pengajuanId}/set-setuju', 'setSetuju')->name('pengajuan.setSetuju');
        Route::post('/pengajuan/{pengajuanId}/set-tolak', 'setTolak')->name('pengajuan.setTolak');
    });
    Route::controller(PesanController::class)->group(function () {
        Route::get('/pesan', 'index')->name('pesan.index');
    });
});

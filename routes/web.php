<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\BerkalaController;

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

Route::get('/', function () { return view('login'); })->name('login');
Route::post('/login_aksi', [AdminController::class,'login_aksi'])->name('login_aksi');
Route::get('/logout', [AdminController::class,'logout'])->name('logout');

Route::group(['prefix' => 'admin'], function(){
    Route::get('/', [AdminController::class, 'dashboard'] )->name('dashboard');
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('pangkat', PangkatController::class);
    Route::resource('berkala', BerkalaController::class);
    Route::get('ubah-password', [AdminController::class, 'IndexPassword'] )->name('IndexPassword');
    Route::post('ubah-password', [AdminController::class, 'UbahPassword'] )->name('UbahPassword');
});


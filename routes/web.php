<?php

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

Route::get('/', function () { return view('login'); })->name('login');
Route::post('/login_aksi', [utamaController::class,'login_aksi'])->name('login_aksi');
Route::get('/logout', [utamaController::class,'logout'])->name('logout');

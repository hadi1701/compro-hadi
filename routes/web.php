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

Route::get('/', function () {
    return view('welcome');
});

// GET
Route::get('belajar',[\App\Http\Controllers\BelajarController::class,'index']);

Route::get('aritmatika', [\App\Http\Controllers\BelajarController::class,'create']);

//aritmatika/tambah adalah yang interaksi dengan database
Route::get('aritmatika/tambah', [\App\Http\Controllers\BelajarController::class,'tambah']); 

Route::get('aritmatika/kurang', [\App\Http\Controllers\BelajarController::class, 'kurang']);

//bagi gk make slash, tapi titik
Route::get('aritmatika/bagi', [\App\Http\Controllers\BelajarController::class, 'bagi'])->name('aritmatika.bagi');

Route::get('aritmatika/kali', [\App\Http\Controllers\BelajarController::class, 'kali'])->name('aritmatika.kali');

// POST
Route::post('tambah-action', [\App\Http\Controllers\BelajarController::class, 'tambahAction'])->name('tambah-action');

Route::post('kurang-action', [\App\Http\Controllers\BelajarController::class, 'kurangAction'])->name('kurang-action');

Route::post('bagi-action', [\App\Http\Controllers\BelajarController::class, 'bagiAction'])->name('bagi-action');

Route::post('kali-action', [\App\Http\Controllers\BelajarController::class, 'kaliAction'])->name('kali-action');




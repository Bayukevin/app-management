<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

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


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/data-barang', [DataBarangController::class, 'index'])->name('data-barang');
    Route::post('/data-barang', [DataBarangController::class, 'store']);
    Route::put('/data-barang/update/{id}', [DataBarangController::class, 'update'])->name('data-barang.update');
    Route::delete('/data-barang/delete/{id}', [DataBarangController::class, 'destroy'])->name('delete-barang');

    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
    Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
    Route::put('/barang-masuk/{id}', [BarangMasukController::class, 'update'])->name('barang-masuk.update');
    Route::delete('/barang-masuk/{id}', [BarangMasukController::class, 'destroy'])->name('barang-masuk.destroy');

    Route::resource('barang-keluar', BarangKeluarController::class);
    Route::put('/barang-keluar/{id}', [BarangKeluarController::class, 'update'])->name('barang-keluar.update');
    Route::delete('/barang-keluar/{id}', [BarangKeluarController::class, 'destroy'])->name('barang-keluar.destroy');
});

Route::get('/users', [UserController::class, 'index']);




Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataBarangController;

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

Route::get('/users', [UserController::class, 'index']);

Route::get('/data-barang', [DataBarangController::class, 'index'])->name('data-barang');
Route::post('/data-barang', [DataBarangController::class, 'store']);
Route::get('/data-barang/edit/{id}', [DataBarangController::class, 'edit'])->name('edit-barang');
Route::delete('/data-barang/delete/{id}', [DataBarangController::class, 'destroy'])->name('delete-barang');


Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


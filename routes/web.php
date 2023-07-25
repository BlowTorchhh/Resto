<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\StrukController;
use App\Http\Controllers\UserController;
use App\Models\Kategori_menu;
use App\Models\Resep;
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
Route::group(['middleware' => ['auth']], function (){
    
    Route::get('print_table/{id}', [PrintController::class, 'printTable']);

    Route::group(['middleware' => ['\App\Http\Middleware\cekUserLogin:1']], function (){
        Route::get('admin', [AdminController::class, 'index']);
        Route::get('role', [AdminController::class, 'role_add']);
        Route::post('role_addProcess', [AdminController::class, 'role_addProcess']);
        Route::patch('role_edit/{id}', [AdminController::class, 'role_editProcess']);
        Route::delete('role_delete/{id}', [AdminController::class, 'role_delete']);

        Route::get('meja', [MejaController::class, 'index']);
        Route::post('meja_addProcess', [MejaController::class, 'meja_addProcess']);
        Route::patch('meja_edit/{id}', [MejaController::class, 'meja_editProcess']);
        Route::delete('meja_delete/{id}', [MejaController::class, 'meja_delete']);

        Route::get('kategori', [KategoriController::class, 'kategori_add']);
        Route::post('kategori_addProcess', [KategoriController::class, 'kategori_addProcess']);
        Route::patch('kategori_edit/{id}', [KategoriController::class, 'kategori_editProcess']);
        Route::delete('kategori_delete/{id}', [KategoriController::class, 'kategori_delete']);

        Route::get('menu', [MenuController::class, 'menu_add']);
        Route::post('menu_addProcess', [MenuController::class, 'menu_addProcess']);
        Route::patch('menu_edit/{id}', [MenuController::class, 'menu_editProcess']);
        Route::delete('menu_delete/{id}', [MenuController::class, 'menu_delete']);

        Route::patch('reservasi_edit/{id}', [ReservasiController::class, 'reservasi_editProcess']);

        Route::get('bahan_baku', [BahanController::class, 'bahan_baku']);
        Route::post('bahan_baku_addProcess', [BahanController::class, 'bahan_baku_addProcess']);
        Route::patch('bahan_baku_edit/{id}', [BahanController::class, 'bahan_baku_editProcess']);
        Route::delete('bahan_baku_delete/{id}', [BahanController::class, 'bahan_baku_delete']);

        Route::get('resep', [ResepController::class, 'resep']);
        Route::post('resep_addProcess', [ResepController::class, 'resep_addProcess']);
        Route::patch('resep_edit/{id}', [ResepController::class, 'resep_editProcess']);
        Route::delete('resep_delete/{id}', [ResepController::class, 'resep_delete']);
        Route::get('detail/{id}', [ResepController::class, 'detail']);

        Route::get('rekening', [RekeningController::class, 'index']);
        Route::post('rekening_addProcess', [RekeningController::class, 'rekening_addProcess']);
        Route::patch('rekening_edit/{id}', [RekeningController::class, 'rekening_editProcess']);
        Route::delete('rekening_delete/{id}', [RekeningController::class, 'rekening_delete']);
    });
    Route::group(['middleware' => ['\App\Http\Middleware\cekUserLogin:2']], function (){
        Route::get('pegawai', [PegawaiController::class, 'index']);
    });
    Route::group(['middleware' => ['\App\Http\Middleware\cekUserLogin:3']], function (){
        Route::get('customer', [CustomerController::class, 'index']);

        Route::get('reservasi', [CustomerController::class, 'reservasi']);
        Route::post('reservasi_addProcess', [StrukController::class, 'reservasi_addProcess']);
        Route::patch('reservasi_editProcess/{id}', [CustomerController::class, 'reservasi_editProcess']);
        Route::delete('reservasi_delete/{id}', [CustomerController::class, 'reservasi_delete']);

        Route::post('keranjang_add/{id}', [HomeController::class, 'addToCart']);
        Route::delete('keranjang_hapus/{id}', [HomeController::class, 'deleteCart']);
        Route::delete('deleteAllCart', [HomeController::class, 'deleteAllCart']);

        
    });
});

Route::get('/', [HomeController::class, 'index']);
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login',[UserController::class, 'loginAction'])->name('loginAction');
Route::get('register', [UserController::class, 'register']);
Route::post('register',[UserController::class, 'registerAction'])->name('registerAction');
Route::get('logout', [UserController::class, 'logout']);
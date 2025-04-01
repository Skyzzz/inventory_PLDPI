<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangKeluarSementaraController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangMasukSementaraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriMediaController;
use App\Http\Controllers\KategoriSuratController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Models\BarangKeluar;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\Media;

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

Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/tbhUser', [UserController::class, 'create']);
    Route::post('/thbUser', [UserController::class, 'store'])->name('tbhUser');
    Route::get('/edtUser/{id}', [UserController::class, 'edit']);
    Route::put('/edtUser/{id}', [UserController::class, 'update']);
    Route::get('/hpsUser/{id}', [UserController::class, 'destroy']);
    Route::get('/profil/{id}', [UserController::class, 'profil']);
    Route::put('/edtProfil/{id}', [UserController::class, 'post_profil'] );
    Route::put('/edtPassword/{id}', [UserController::class, 'password']);

    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::get('/tbhPegawai', [PegawaiController::class, 'create']);
    Route::post('/tbhPegawai', [PegawaiController::class, 'store'])->name('tbhPegawai');
    Route::post('/keyPegawai/{id}', [PegawaiController::class, 'konfir'])->name('konfir');
    Route::get('/edtPegawai/{id}', [PegawaiController::class, 'edit']);
    Route::put('/edtPegawai/{id}', [PegawaiController::class, 'update'])->name('uptPegawai');
    Route::get('/hpsPegawai/{id}', [PegawaiController::class, 'destroy']);

    Route::get('/pemasok', [PemasokController::class, 'index']);
    Route::get('/tbhPemasok', [PemasokController::class, 'create']);
    Route::post('/tbhPemasok', [PemasokController::class, 'store'])->name('tbhPemasok');
    Route::get('/edtPemasok/{id}', [PemasokController::class, 'edit']);
    Route::put('/edtPemasok/{id}', [PemasokController::class, 'update']);
    Route::get('/hpsPemasok/{id}', [PemasokController::class, 'destroy']);

    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/tbhKategori', [KategoriController::class, 'store']);
    Route::put('/edtKategori/{id}', [KategoriController::class, 'update']);
    Route::get('/hpsKategori/{id}', [KategoriController::class, 'destroy']);

    Route::get('/barang', [BarangController::class, 'index']);
    Route::get('/hpsBarang/{id}', [BarangController::class, 'destroy']);
    Route::get('/tbhBarang', [BarangController::class, 'create']);
    Route::post('/tbhBarang', [BarangController::class, 'store'])->name('tbhBarang');
    Route::get('/edtBarang/{id}', [BarangController::class, 'edit']);
    Route::post('/edtBarang/{id}', [BarangController::class, 'update']);

    Route::get('/barang_masuk', [BarangMasukController::class, 'index']);
    Route::get('/tbhBarang_masuk', [BarangMasukController::class, 'create']);
    Route::get('/list/{id}', [BarangMasukController::class, 'get_barang']);
    Route::post('/tbhBarang_masuk', [BarangMasukController::class, 'store']);
    Route::get('/edtBarang_masuk', [BarangMasukController::class, 'edit']);
    Route::get('/hpsBarang_masuk/{id}', [BarangMasukController::class, 'destroy']);

    Route::get('/barang_keluar', [BarangKeluarController::class, 'index']);
    Route::get('/tbhBarang_keluar', [BarangKeluarController::class, 'create']);
    Route::get('/tampil_bk/{id}', [BarangKeluarController::class, 'get_barang']);
    Route::get('/hpsBarang_keluar/{id}', [BarangKeluarController::class, 'destroy']);
    Route::post('/tbhBarang_keluar', [BarangKeluarController::class, 'store'])->name('tbhBarang_keluar');

    Route::get('/kategori_media', [KategoriMediaController::class, 'index']);
    Route::post('/tbhKategoriMedia', [KategoriMediaController::class, 'store']);
    Route::put('/edtKategoriMedia/{id}', [KategoriMediaController::class, 'update']);
    Route::get('/hpsKategoriMedia/{id}', [KategoriMediaController::class, 'destroy']);

    Route::get('/media', [MediaController::class, 'index']);
    Route::get('/media_detail', [MediaController::class, 'index_detail']);
    Route::get('/detailMedia/{id}', [MediaController::class, 'detail']);
    Route::get('/tbhMedia', [MediaController::class, 'create']);
    Route::get('/hpsMedia/{id}', [MediaController::class, 'destroy']);
    Route::post('/tbhMedia', [MediaController::class, 'store'])->name('tbhMedia');

    Route::get('/kategori_surat', [KategoriSuratController::class, 'index']);
    Route::post('/tbhKategoriSurat', [KategoriSuratController::class, 'store']);
    Route::put('/edtKategoriSurat/{id}', [KategoriSuratController::class, 'update']);
    Route::get('/hpsKategoriSurat/{id}', [KategoriSuratController::class, 'destroy']);

    Route::get('/surat_masuk', [SuratMasukController::class, 'index']);
    Route::get('/surat_masuk_detail', [SuratMasukController::class, 'index_detail']);
    Route::get('/tbhSuratMasuk', [SuratMasukController::class, 'create']);
    Route::post('/surat_masuk', [SuratMasukController::class, 'store'])->name('tbhSuratMasuk');
    Route::get('/edtSuratMasuk/{id}', [SuratMasukController::class, 'edit']);
    Route::get('/detailSuratMasuk/{id}', [SuratMasukController::class, 'detail']);
    Route::put('/surat_masuk/{id}', [SuratMasukController::class, 'update']);
    Route::get('/hpsSuratMasuk/{id}', [SuratMasukController::class, 'destroy']);

    Route::get('/surat_keluar', [SuratKeluarController::class, 'index']);
    Route::get('/surat_keluar_detail', [SuratKeluarController::class, 'index_detail']);
    Route::get('/tbhSuratKeluar', [SuratKeluarController::class, 'create']);
    Route::post('/surat_keluar', [SuratKeluarController::class, 'store'])->name('tbhSuratKeluar');
    Route::get('/edtSuratKeluar/{id}', [SuratKeluarController::class, 'edit']);
    Route::get('/detailSuratKeluar/{id}', [SuratKeluarController::class, 'detail']);
    Route::put('/surat_keluar/{id}', [SuratKeluarController::class, 'update']);
    Route::get('/hpsSuratKeluar/{id}', [SuratKeluarController::class, 'destroy']);

    Route::get('/laporan', [DashboardController::class, 'laporan']);
    Route::post('/laporan', [DashboardController::class, 'cetak_laporan'])->name('cetak_laporan');
    
    Route::get('/streamMedia/{id}', [MediaController::class, 'streamMedia'])->name('streamMedia');
    Route::get('/streamSuratMasuk/{id}', [SuratMasukController::class, 'streamSuratMasuk'])->name('streamSuratMasuk');
    Route::get('/streamSuratKeluar/{id}', [SuratKeluarController::class, 'streamSuratKeluar'])->name('streamSuratKeluar');

});

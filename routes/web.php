<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MainController;
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
Route::get('/',[MainController::class,'login'])->name('login');
Route::get('/login',[MainController::class,'login'])->name('login');
Route::post('/autentikasi',[MainController::class,'autentikasi'])->name('autentikasi');
Route::post('/logout',[MainController::class,'logout'])->name('logout');

Route::middleware('CheckRole:Karyawan')->group(function(){
    // Route::get('/',[MainController::class,'login'])->name('login');
    Route::get('/presensi',[KaryawanController::class,'k_presensi'])->name('k_presensi');
    Route::get('/presensi/pilih-kelas/{id_kelas}',[KaryawanController::class,'PilihKelas'])->name('karyawan.pilih_kelas');
    Route::post('/presensi/unggah',[KaryawanController::class,'unggah_presensi'])->name('karyawan.unggah_presensi');    
});

//Admin
Route::middleware('CheckRole:Admin')->group(function(){
// Localization

Route::post('/admin/localization',[AdminController::class,'loc'])->name('loc');

    // Presensi
Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
Route::get('/admin/presensi',[AdminController::class,'presensi'])->name('admin.presensi');
Route::get('/admin/presensi/{id_kelas}/{tanggal}',[AdminController::class,'cari_presensi'])->name('admin.cari_presensi');
Route::post('/admin/user/update',[AdminController::class,'update'])->name('admin.update');
Route::delete('/admin/user/delete',[AdminController::class,'delete'])->name('admin.delete_presensi');

// Akun User
Route::get('/admin/user',[AdminController::class,'user_list'])->name('admin.user');
Route::post('/admin/user/tambah',[AdminController::class,'tambah_user'])->name('admin.tambah_user');
Route::delete('/admin/user/delete/{id}',[AdminController::class,'hapus_user'])->name('admin.hapus_user');
Route::put('/admin/user/edit/{id}',[AdminController::class,'edit_user'])->name('admin.edit_user');

// Data Peserta Didik
Route::get('/admin/siswa',[AdminController::class,'siswa_list'])->name('admin.siswa');
Route::post('/admin/siswa/tambah',[AdminController::class,'tambah_siswa'])->name('admin.tambah_siswa');
Route::put('/admin/siswa/edit/{id}',[AdminController::class,'edit_siswa'])->name('admin.edit_siswa');
Route::delete('/admin/siswa/delete/{id}',[AdminController::class,'hapus_siswa'])->name('admin.hapus_siswa');

// Rekapitulasi
Route::get('/admin/rekapitulasi',[AdminController::class,'rekap'])->name('admin.rekap');
Route::get('/admin/rekapitulasi/cari-kelas',[AdminController::class,'rekap_cari_kelas'])->name('admin.rekap_cari_kelas');
Route::get('/Admin/export-excel', 'AdminController@exportExcel')->name('export.excel');


// Data Kelas
Route::get('/admin/kelas',[AdminController::class,'list_kelas'])->name('admin.kelas');
Route::post('/admin/kelas/tambah',[AdminController::class,'tambah_kelas'])->name('admin.tambah_kelas');
Route::put('/admin/kelas/edit/{id}',[AdminController::class,'edit_kelas'])->name('admin.edit_kelas');
Route::delete('/admin/kelas/hapus/{id}',[AdminController::class,'hapus_kelas'])->name('admin.hapus_kelas');
});

// Manajemen
Route::middleware('CheckRole:Manajemen')->group(function(){
Route::get('/manajemen',[AdminController::class,'rekap'])->name('manajemen');
Route::get('/manajemen/rekapitulasi/cari-kelas',[AdminController::class,'rekap_cari_kelas'])->name('manajemen.rekap_cari_kelas');
Route::get('/Manajemen/export-excel', 'AdminController@exportExcel')->name('manajemen.export_excel');
});


// Debug 
Route::get('/debug',[DebugController::class,'debug'])->name('debug');
// Route::post('/presensi/ajax-pilih-kelas',[KaryawanController::class,'ajaxPilihKelas'])->name('karyawan.ajax_pilih_kelas');

// Route::get('/main/{debug?}',[MainController::class,'index'],function($debug = null){return $debug;});
// Route::get('/login',[MainController::class,'login']);
// Route::get('/files',[MainController::class,'files']);
Route::get('/rekap/{debug?}',[DebugController::class,'rekap']);
// Route::get('/presensi/{id_kelas}',[MainController::class,'presensi'])->name('presensi');
// Route::get('/log',[MainController::class,'log']);
// Route::post('/presensi_kehadiran',[MainController::class,'presensi_kehadiran'])->name('presensi_kehadiran');
//debug resource
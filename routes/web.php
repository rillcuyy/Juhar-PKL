<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DudiController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\PembimbingController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\GuruLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::middleware(['guest'])->group(function(){
    Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/admin/submit', [AdminLoginController::class, 'submit'])->name('admin.submit');
    
    Route::get('/guru/login', [GuruLoginController::class, 'login'])->name('guru.login');
    Route::post('/guru/submit', [GuruLoginController::class, 'submit'])->name('guru.submit');
    
});

Route::middleware(['admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/profile/update', [AdminController::class, 'update'])->name('admin.profile_update');

    
    Route::get('/admin/Guru', [GuruController::class, 'Guru'])->name('admin.Guru');
    Route::get('/admin/Guru/tambah', [GuruController::class, 'create'])->name('admin.guru_tambah');
    Route::post('/admin/Guru/tambah', [GuruController::class, 'store'])->name('admin.guru_store');
    Route::get('/admin/Guru/edit/{id}', [GuruController::class, 'edit'])->name('admin.guru_edit');
    Route::put('/admin/Guru/update/{id}', [GuruController::class, 'update'])->name('admin.guru_update');
    Route::get('/admin/Guru/delete/{id}', [GuruController::class, 'delete'])->name('admin.guru_delete');
    
    Route::get('/admin/Dudi', [DudiController::class, 'Dudi'])->name('admin.Dudi');
    Route::get('/admin/Dudi/tambah', [DudiController::class, 'create'])->name('admin.dudi_tambah');
    Route::post('/admin/Dudi/tambah', [DudiController::class, 'store'])->name('admin.dudi_store');
    Route::get('/admin/Dudi/edit/{id}', [DudiController::class, 'edit'])->name('admin.edit_dudi');
    Route::put('/admin/Dudi/update/{id}', [DudiController::class, 'update'])->name('admin.dudi_update');
    Route::get('/admin/Dudi/delete/{id}', [DudiController::class, 'delete'])->name('admin.dudi_delete');
   


    Route::get('/admin/Pembimbing', [PembimbingController::class, 'Pembimbing'])->name('admin.Pembimbing');
    Route::get('/admin/Pembimbing/tambah', [PembimbingController::class, 'create'])->name('admin.tambah_pembimbing');
    Route::post('/admin/Pembimbing/tambah', [PembimbingController::class, 'store'])->name('admin.Pembimbing_store');
    Route::get('/admin/Pembimbing/edit/{id}', [PembimbingController::class, 'edit'])->name('admin.Pembimbing_edit');
    Route::put('/admin/Pembimbing/update/{id}', [PembimbingController::class, 'update'])->name('admin.Pembimbing_update');
    Route::get('/admin/Pembimbing/delete/{id}', [PembimbingController::class, 'delete'])->name('admin.Pembimbing_delete');

    
    Route::get('/admin/Pembimbing/{id}/siswa', [SiswaController::class, 'siswa'])->name('admin.siswa');
    Route::get('/admin/Pembimbing/{id}/siswa/tambah', [SiswaController::class, 'create'])->name('admin.siswa_create');
    Route::post('/admin/Pembimbing/{id}/siswa', [SiswaController::class, 'store'])->name('admin.siswa_store');
    Route::get('/admin/Pembimbing/{id}/siswa/edit/{id_siswa}', [SiswaController::class, 'edit'])->name('admin.siswa_edit');
    Route::put('/admin/Pembimbing/{id}/siswa/edit/{id_siswa}', [SiswaController::class, 'update'])->name('admin.siswa_update');
    Route::get('admin/Pembimbing/{id}/siswa/delete/{id_siswa}', [SiswaController::class, 'delete'])->name('admin.siswa_delete');


    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
   

});

Route::middleware(['guru'])->group(function(){
    Route::get('/guru/dashboard', [GuruLoginController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru/pembimbing', [PembimbingController::class, 'PembimbingGuru'])->name('guru.pembimbing');
    Route::get('/guru/Pembimbing/{id}/siswa', [SiswaController::class, 'siswaGuru'])->name('guru.pembimbing_siswa');

    Route::get('/guru/profile', [GuruController::class, 'profileGuru'])->name('guru.profile_guru');
    Route::put('/guru/profile/update', [GuruController::class, 'updateGuru'])->name('guru.guru_update');

    Route::get('/guru/logout', [GuruController::class, 'logoutGuru'])->name('guru.logout');
});

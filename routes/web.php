<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DudiController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::middleware(['guest'])->group(function(){
    Route::get('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/admin/submit', [AdminLoginController::class, 'submit'])->name('admin.submit');
});

Route::middleware(['admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/Guru', [GuruController::class, 'Guru'])->name('admin.Guru');
    Route::get('/admin/Guru/tambah', [GuruController::class, 'create'])->name('admin.guru_tambah');
    Route::post('/admin/Guru/tambah', [GuruController::class, 'store'])->name('admin.guru_store');
    Route::get('/admin/Guru/edit/{id}', [GuruController::class, 'edit'])->name('admin.guru_edit');
    Route::put('/admin/Guru/update/{id}', [GuruController::class, 'update'])->name('admin.guru_update');
    Route::get('/admin/Guru/delete/{id}', [GuruController::class, 'delete'])->name('admin.guru_delete');
    
    Route::get('/admin/Dudi', [DudiController::class, 'Dudi'])->name('admin.Dudi');
    Route::get('/admin/Pembimbing', [AdminController::class, 'Pembimbing'])->name('admin.Pembimbing');

    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

});

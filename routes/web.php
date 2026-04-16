<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\ObatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ================= ADMIN =================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD Poli
    Route::resource('polis', PoliController::class);

    // CRUD Dokter
    Route::resource('dokter', DokterController::class);

    // CRUD Pasien
    Route::resource('pasien', PasienController::class);

    // CRUD Obat
    Route::resource('obat', ObatController::class);

});


// ================= DOKTER =================
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {

    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

});


// ================= PASIEN =================
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {

    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

});
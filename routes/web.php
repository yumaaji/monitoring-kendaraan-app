<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ChartKendaraanController;
use App\Http\Controllers\TransportationController;

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

Route::get('/', [Authentication::class, 'index'])->name('index');
Route::post('/login', [Authentication::class, 'login'])->name('login');
Route::post('/logout', [Authentication::class, 'logout'])->name('logout');

// Admin/Petugas
Route::middleware('auth')->group(function () {  
  Route::get('/dashboard/admin', [ChartKendaraanController::class, 'index'])->name('dashboard.admin');
  Route::resource('/company', CompanyController::class);
  Route::resource('/kendaraan', TransportationController::class);
  Route::resource('/driver', DriverController::class);
  Route::resource('/pengajuan', LendingController::class);
});

// Penyetuju
Route::middleware('auth')->group(function () {
  Route::get('/dashboard/penjabat', [ChartKendaraanController::class, 'index'])->name('dashboard.penjabat');
  Route::get('/pengajuan-kendaraan', [LendingController::class, 'list'])->name('pengajuan-kendaraan');
  Route::put('/pengajuan-approve/{id}', [LendingController::class, 'approve'])->name('pengajuan-approve');
  Route::put('/pengajuan-unapprove/{id}', [LendingController::class, 'unapprove'])->name('pengajuan-unapprove');
  Route::put('/pengajuan-waiting/{id}', [LendingController::class, 'waiting'])->name('pengajuan-waiting');
  Route::get('/pengajuan-export', [LendingController::class, 'export']);
});

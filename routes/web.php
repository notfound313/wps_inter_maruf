<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DailyLogController;
use App\Http\Controllers\LogVerificationController;


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
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
});


Route::middleware(['auth'])->group(function () {
    Route::get('/log/daily-log', [DailyLogController::class, 'index'])->name('log/daily-log');
    Route::post('/log/daily-log', [DailyLogController::class, 'store'])->name('daily-log.store');
    Route::put('/log/daily-log/{log}/status', [DailyLogController::class, 'updateStatus'])->name('daily-log.update-status');    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/log-verification', [LogVerificationController::class, 'index'])->name('log-verification.index');
    Route::get('/log-verification/rejected', [LogVerificationController::class, 'getRejectedLogs'])->name('log-verification.reject');
    Route::get('/log-verification/accepted', [LogVerificationController::class, 'getAcceptedLogs'])->name('log-verification.accept');
    Route::put('/log-verification/{log}', [LogVerificationController::class, 'update'])->name('log-verification.update');
});

// Route::get('/log/daily-log', [DailyLogController::class, 'index'])->name('log/daily-log');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');




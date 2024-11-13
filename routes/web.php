<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordOtpController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('password/otp', [ForgotPasswordOtpController::class, 'showOtpForm'])->name('password.otp.form');
Route::post('password/otp', [ForgotPasswordOtpController::class, 'sendOtp'])->name('password.send.otp');

Route::get('password/verify-otp', [ForgotPasswordOtpController::class, 'showOtpVerificationForm'])->name('password.verifyOtp');
Route::post('password/verify-otp', [ForgotPasswordOtpController::class, 'verifyOtp'])->name('password.verifyOtp.submit');

Route::get('password/reset', [ForgotPasswordOtpController::class, 'showPasswordResetForm'])->name('user-password.reset');
Route::post('password/reset', [ForgotPasswordOtpController::class, 'resetPassword'])->name('password.update');


Route::get('/admin/login', [LoginController::class,'showLoginForm'])->name('admin.login');
Route::get('/user/dashboard', [HomeController::class,'dashboard'])->name('user.dashboard');
Route::post('/admin/login', [LoginController::class,'login'])->name('admin.login.process');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home');


Route::group(['prefix' => 'admin/', 'namespace' => 'Admin\\', 'as' => 'admin.', 'middleware' => ['isSuperAdmin']], function () {
    Route::get('dashboard', [DashboardController::class,'dashboard'])->name('dashboard');
});

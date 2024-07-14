<?php


use App\Http\Controllers\Auth\AuthController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.home');
});

Route::get('/dang-nhap', [AuthController::class, 'formLogin'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'login']);
Route::get('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
Route::get('/dang-ky', [AuthController::class, 'formRegister'])->name('register');
Route::post('/dang-ky', [AuthController::class, 'register']);
Route::get('/quen-mat-khau', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/quen-mat-khau', [AuthController::class, 'checkForgotPassword'])->name('checkForgotPassword');
Route::get('/doi-mat-khau/{token}', [AuthController::class, 'formChangePassword'])->name('formChangePassword');
Route::post('/doi-mat-khau/{token}', [AuthController::class, 'changePassword'])->name('changePassword');


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;

Route::middleware('is_admin')->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
    Route::prefix('auth')->as('auth.')->group(function () {
        Route::get('{id}/profile', [AuthController::class, 'profileUser'])->name('profile');
        Route::get('/profile/{id}/setting', [AuthController::class, 'profileSetting'])->name('setting');
        Route::post('/profile/{id}/setting', [AuthController::class, 'updateProfile'])->name('update');
    });
    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/trash', [UserController::class, 'trash'])->name('trash');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/create', [UserController::class, 'store'])->name('store');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [UserController::class, 'update'])->name('update');
        Route::get('{id}/delsoft', [UserController::class, 'delSoft'])->name('delsoft');
        Route::get('{id}/restore', [UserController::class, 'restore'])->name('restore');
        Route::get('{id}/delete', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('catalogues')->as('catalogues.')->group(function () {
        Route::get('/', [CatalogueController::class, 'index'])->name('index');
        Route::get('/trash', [CatalogueController::class, 'trash'])->name('trash');
        Route::get('/create', [CatalogueController::class, 'create'])->name('create');
        Route::post('/create', [CatalogueController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CatalogueController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [CatalogueController::class, 'update'])->name('update');
        Route::get('{id}/delsoft', [CatalogueController::class, 'delSoft'])->name('delsoft');
        Route::get('{id}/restore', [CatalogueController::class, 'restore'])->name('restore');
        Route::get('{id}/delete', [CatalogueController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('post')->as('post.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/trash', [PostController::class, 'trash'])->name('trash');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/create', [PostController::class, 'store'])->name('store');
        Route::get('{id}/show', [PostController::class, 'show'])->name('show');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::post('{id}/update', [PostController::class, 'update'])->name('update');
        Route::get('{id}/delsoft', [PostController::class, 'delSoft'])->name('delsoft');
        Route::get('{id}/restore', [PostController::class, 'restore'])->name('restore');
        Route::get('{id}/delete', [PostController::class, 'destroy'])->name('destroy');
    });
});

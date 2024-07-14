<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;

Route::prefix('')->as('')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('{id}/{slug}', [HomeController::class, 'detailPost'])->name('detail-post');
    Route::get('/tin-tuc/the-loai/{id}/{slug}', [HomeController::class, 'PostByCatalogue'])->name('catalogue-news');
    Route::post('/tin-tuc/{id}/binh-luan', [HomeController::class, 'comment'])->name('comment-news');
    Route::get('/tim-kiem', [HomeController::class, 'searchNews'])->name('search-news');
    Route::get('/lien-he', [HomeController::class, 'contact'])->name('contact');
    Route::post('/lien-he', [HomeController::class, 'sendContact'])->name('send-contact');
    Route::get('/gioi-thieu', [HomeController::class, 'about'])->name('about');
});

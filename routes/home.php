<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;

Route::prefix('')->as('')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('{id}/{slug}', [HomeController::class, 'detailPost'])->name('detail-post');
    Route::get('/tin-tuc/the-loai/{id}/{slug}', [HomeController::class, 'PostByCatalogue'])->name('catalogue-news');
    Route::post('/tin-tuc/{id}/binh-luan', [HomeController::class, 'comment'])->middleware('is_user')->name('comment-news');
    Route::get('/tim-kiem', [HomeController::class, 'searchNews'])->name('search-news');
    Route::get('/lien-he', [HomeController::class, 'contact'])->name('contact');
    Route::post('/lien-he', [HomeController::class, 'sendContact'])->name('send-contact');
    Route::get('/gioi-thieu', [HomeController::class, 'about'])->name('about');
    Route::post('/increment-view', [HomeController::class, 'incrementView'])->name('increment-view');
    Route::get('/profile', [HomeController::class, 'showProfile'])->name('profile');
  

    Route::post('/profile', [HomeController::class, 'update'])->name('profile.update');
});

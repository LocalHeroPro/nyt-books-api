<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\NYT\Books\BestSellerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:nyt'])->prefix('nyt')->name('nyt.')->group(function () {
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('best-sellers', BestSellerController::class)->name('best_sellers');
    });
});

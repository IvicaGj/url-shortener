<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\UrlController::class, 'index']);
Route::post('/', [App\Http\Controllers\UrlController::class, 'shortenUrl'])->name('shorten');
Route::get('/{hash}', [App\Http\Controllers\UrlController::class, 'serveShortenedUrl']);
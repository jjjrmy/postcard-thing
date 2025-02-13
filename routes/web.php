<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\PostcardController::class, 'create'])->name('postcards.create');
Route::resource('postcards', App\Http\Controllers\PostcardController::class)->except(['index', 'create']);
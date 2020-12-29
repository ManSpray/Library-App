<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', [App\Http\Controllers\AuthorController::class, 'index']);
    Route::resource('author', App\Http\Controllers\AuthorController::class);
    Route::resource('book', App\Http\Controllers\BookController::class);
    Route::resource('customer', App\Http\Controllers\CustomerController::class);
    
    // Route::get('search', [App\Http\Controllers\CountryController::class, 'search']);
    // Route::get('autocomplete', [App\Http\Controllers\CountryController::class, 'autocomplete'])->name('autocomplete');
});

Auth::routes(['register' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
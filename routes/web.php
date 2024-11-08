<?php

use App\Http\Controllers\LibraryController;
use Illuminate\Support\Facades\Route;

Route::get('/',[LibraryController::class, 'show'])->name('library.show');
Route::post('/add', [LibraryController::class, 'add'])->name('library.add');

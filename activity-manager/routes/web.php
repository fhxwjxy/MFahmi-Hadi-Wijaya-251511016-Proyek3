<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;

Route::redirect('/', '/activities');
Route::resource('activities', ActivityController::class);
Route::resource('categories', CategoryController::class);
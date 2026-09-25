<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

Route::redirect('/', '/activities');
Route::resource('activities', ActivityController::class);
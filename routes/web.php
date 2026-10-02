<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;

Route::get('/experiment-n-plus-1', function () {
    // --- Percobaan 1: LAZY LOADING (tanpa eager loading) ---
    $queryCount1 = 0;
    DB::listen(function ($query) use (&$queryCount1) {
        $queryCount1++;
    });

    $activities = Activity::limit(10)->get(); // TANPA with('category')
    foreach ($activities as $activity) {
        $categoryName = $activity->category->name; // tiap loop ini trigger query baru!
    }

    $lazyCount = $queryCount1;

    // --- Percobaan 2: EAGER LOADING ---
    $queryCount2 = 0;
    DB::listen(function ($query) use (&$queryCount2) {
        $queryCount2++;
    });

    $activities2 = Activity::with('category')->limit(10)->get(); // DENGAN with('category')
    foreach ($activities2 as $activity) {
        $categoryName = $activity->category->name; // tidak trigger query baru, sudah di-load di awal
    }

    $eagerCount = $queryCount2 - $lazyCount; // kurangi supaya tidak double-hitung dari listener pertama

    return response()->json([
        'lazy_loading_query_count' => $lazyCount,
        'eager_loading_query_count' => $eagerCount,
    ]);
});

Route::redirect('/', '/activities');
Route::resource('activities', ActivityController::class);
Route::resource('categories', CategoryController::class);
Route::get('activities-trash', [ActivityController::class, 'trash'])->name('activities.trash');
Route::post('activities/{id}/restore', [ActivityController::class, 'restore'])->name('activities.restore');
Route::delete('activities/{id}/force-delete', [ActivityController::class, 'forceDelete'])->name('activities.force-delete');

Route::post('activities/{activity}/publish', [ActivityController::class, 'publish'])->name('activities.publish');
Route::post('activities/{activity}/complete', [ActivityController::class, 'complete'])->name('activities.complete');
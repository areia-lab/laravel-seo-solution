<?php

use Illuminate\Support\Facades\Route;
use AreiaLab\LaravelSeoSolution\Http\Controllers\SeoController;

Route::group([
    'prefix' => config('seo.route.prefix'),
    'middleware' => config('seo.route.middleware'),
], function () {
    Route::get('/', [SeoController::class, 'index'])->name('seo.index');
    Route::get('/create', [SeoController::class, 'create'])->name('seo.create');
    Route::post('/', [SeoController::class, 'store'])->name('seo.store');
    Route::get('/{seo}/edit', [SeoController::class, 'edit'])->name('seo.edit');
    Route::put('/{seo}', [SeoController::class, 'update'])->name('seo.update');
    Route::delete('/{seo}', [SeoController::class, 'destroy'])->name('seo.destroy');
});

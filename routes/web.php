<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', [HomeController::class, 'index']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});

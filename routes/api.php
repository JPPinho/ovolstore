<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
// Product routes
Route::apiResource('products', \App\Http\Controllers\API\ProductController::class);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\KeyValidation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('link-minifier', [\App\Http\Controllers\MainController::class, 'index'])
    ->middleware(\App\Http\Middleware\LinkValidation::class);

Route::get('{key}', [\App\Http\Controllers\MainController::class, 'redirect'])
    ->middleware(KeyValidation::class);

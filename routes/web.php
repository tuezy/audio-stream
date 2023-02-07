<?php

use Illuminate\Foundation\PackageManifest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', [\App\Http\Controllers\Index\AuthController::class, "login"])->name("index.login");
Route::get('/', [\App\Http\Controllers\Index\HomeController::class, "home"])->name("index");




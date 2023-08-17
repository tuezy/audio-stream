<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::any("live", [\App\Http\Controllers\Api\LiveController::class, "live"]);
Route::post("customer/enable/live", [\App\Http\Controllers\Api\LiveController::class, "enable"])->name("api.livestream.enable");

Route::get("live/publish", [\App\Http\Controllers\Api\LiveController::class, "publish"])->name("api.livestream.publish");
Route::get("live/publish_done", [\App\Http\Controllers\Api\LiveController::class, "publish_done"])->name("api.livestream.publish_done");
Route::get("live/publish_livestream", [\App\Http\Controllers\Api\LiveController::class, "publish_livestream"])->name("api.livestream.publish_livestream");
Route::get("live/done_livestream", [\App\Http\Controllers\Api\LiveController::class, "done_livestream"])->name("api.livestream.done_livestream");
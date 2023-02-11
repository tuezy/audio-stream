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
Route::get('/dashboard', [\App\Http\Controllers\Dashboard\IndexController::class, 'index'])->defaults('_config', [
    'permission_title' => 'View Dashboard'
])->name('dashboard.index');
Route::get('/login', [\App\Http\Controllers\Index\AuthController::class, "showLoginForm"])->name("index.login");
Route::post('/login', [\App\Http\Controllers\Index\AuthController::class, "login"])->name("index.login.post");
Route::get('/quen-mat-khau', [\App\Http\Controllers\Index\AuthController::class, "showResetPasswordForm"])->name("index.reset-pass");
Route::post('/quen-mat-khau', [\App\Http\Controllers\Index\AuthController::class, "ResetPassword"])->name("index.reset-pass.post");
Route::middleware('auth:customers')->group(function (){
    Route::get('/', [\App\Http\Controllers\Index\HomeController::class, "home"])->name("index");
    Route::name('customers.')->group(function(){
        Route::post('/customers/logout', [\App\Http\Controllers\Index\CustomerController::class, "logout"])->name("logout");
        Route::post('/customers/upload', [\App\Http\Controllers\Index\CustomerController::class, "upload"])->name("upload");
        Route::put('/customers/upload/audio', [\App\Http\Controllers\Index\CustomerController::class, "uploadAudio"])->name("upload.audio");
        Route::put('/customers/upload/video', [\App\Http\Controllers\Index\CustomerController::class, "uploadVideo"])->name("upload.video");

        Route::delete('/customers/delete/video', [\App\Http\Controllers\Index\CustomerController::class, "deleteVideo"])->name("delete.video");
        Route::delete('/customers/delete/audio', [\App\Http\Controllers\Index\CustomerController::class, "deleteAudio"])->name("delete.audio");

        Route::get('/customers/panel', [\App\Http\Controllers\Index\CustomerController::class, "panel"])->name("panel");

        Route::post('/customers/doi-mat-khau', [\App\Http\Controllers\Index\CustomerController::class, "changePassword"])->name("changePassword");

        Route::get('/customers/make-playlist/{id}', [\App\Http\Controllers\Index\CustomerController::class, "makePlaylist"])->name("make.playlist");
    });

    Route::get('/phim', [\App\Http\Controllers\Index\VideoController::class, "index"])->name("video.index");
    Route::get('/phim/{slug}', [\App\Http\Controllers\Index\VideoController::class, "slug"])->name("video.slug");
    Route::delete('/phim/delete', [\App\Http\Controllers\Index\VideoController::class, "delete"])->name("video.delete");


    Route::get('/phat-thanh-buoi-sang', [\App\Http\Controllers\Index\HomeController::class, "morning"])->name("home.sang");
    Route::get('/phat-thanh-buoi-trua', [\App\Http\Controllers\Index\HomeController::class, "afternoon"])->name("home.trua");
    Route::get('/phat-thanh-buoi-toi', [\App\Http\Controllers\Index\HomeController::class, "evening"])->name("home.toi");
    Route::post('/{broadcaston}/playlist', [\App\Http\Controllers\Index\HomeController::class, "loadPlaylist"])->name("broadcaston.playlist");

    Route::get('/timkiem', [\App\Http\Controllers\Index\SearchController::class, "search"])->name("index.timkiem");
});



Route::get('/hls/audio/{broadcast_on}/{customer_id}/playlist.m3u8', [App\Http\Controllers\PlayController::class, 'play'])->name('playlist.m3u8');

Route::get('baoloi', [App\Http\Controllers\Index\LoiController::class, 'index'])->name('baoloi');

Route::get('{any}', [App\Http\Controllers\Index\HomeController::class, 'home'])->name('any');
<?php

use Illuminate\Support\Facades\Route;
Route::middleware('auth:customers')->group(function (){
    Route::prefix("livestream")->name("livestream.")->group(function (){
        Route::get("/", [\App\Http\Controllers\Index\LivestreamController::class, "index"])->name("index");
        Route::get("/customer/{channel}", [\App\Http\Controllers\Index\LivestreamController::class, "channel"])->name("customer.channel");
    });


});


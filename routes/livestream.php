<?php

use Illuminate\Support\Facades\Route;
Route::prefix("livestream")->name("livestream.")->group(function (){
    Route::get("/", [\App\Http\Controllers\Index\LivestreamController::class, "index"])->name("index");
});

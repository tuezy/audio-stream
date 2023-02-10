<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Str::contains(Route::currentRouteName(), 'dashboard')){
                return route('dashboard.login');
            }
            return route('index.login');

        }
    }
}

<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Bouncer extends Facade{
    protected static function getFacadeAccessor()
    {
        return 'bouncer';
    }
}

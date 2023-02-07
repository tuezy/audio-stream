<?php

namespace App\Http\Controllers\Index;

use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends IndexController
{

    public function __construct()
    {

    }

    public function home(){
        $cms = Cms::query()->select('title', 'content')->limit(6)->get();

        return view("index.pages.home", [
            'cms' => $cms
        ]);
    }
}

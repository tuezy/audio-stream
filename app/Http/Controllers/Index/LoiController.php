<?php

namespace App\Http\Controllers\Index;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class LoiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){

       return view("index.pages.baoloi.index", [
           'link' => request()->get('link'),
           'message' => request()->get('message'),
       ]);
    }
}

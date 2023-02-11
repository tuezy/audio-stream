<?php

namespace App\Http\Controllers\Index;

use App\Models\Cms;
use App\Models\Customer;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends IndexController
{

    public function __construct()
    {

    }

    public function home(Request $request){
//        $broadcast_on = "p";
//        $user = Auth::guard("customers")->user();
//        $playlists = $user->playlist()->where('broadcast_on','=',$broadcast_on)->limit(10)->get();
//
//        $cms = Cms::query()->where('visibility','=', 1)->select('title', 'content')->limit(6)->get();
//
//        return view("index.pages.home", [
//            'cms' => $cms,
//            'user' => $user,
//            'playlists' => $playlists->groupBy("broadcast_date")->toArray()
//        ]);

        return redirect()->to(route("home.sang"));
    }

    public function morning(Request $request){
        $broadcast_on = "phat-thanh-buoi-sang";

        $cms = Cms::query()->where('visibility','=', 1)->select('title', 'content')->limit(6)->get();
        return view("index.pages.home", [
            'cms' => $cms,
            'user' => $this->user(),
            'playlists' => $this->playlist($broadcast_on)->limit(10)->get()->groupBy("broadcast_date")->toArray()
        ]);
    }

    public function afternoon(Request $request){
        $broadcast_on = "phat-thanh-buoi-trua";

        $cms = Cms::query()->where('visibility','=', 1)->select('title', 'content')->limit(6)->get();
        return view("index.pages.home", [
            'cms' => $cms,
            'user' => $this->user(),
            'playlists' => $this->playlist($broadcast_on)->limit(10)->get()->groupBy("broadcast_date")->toArray()
        ]);
    }

    public function evening(Request $request){
        $broadcast_on = "phat-thanh-buoi-toi";

        $cms = Cms::query()->where('visibility','=', 1)->select('title', 'content')->limit(6)->get();
        return view("index.pages.home", [
            'cms' => $cms,
            'user' => $this->user(),
            'playlists' => $this->playlist($broadcast_on)->limit(10)->get()->groupBy("broadcast_date")->toArray()
        ]);
    }


    public function loadPlaylist($broadcaston, Request $request){
        $data = $request->get('data');
        $audio = $this->user()->audio()->where('playlist_id', '=', $data['id'])->orderBy('index','asc')->get();
        return view("index.pages.audio.playlist", ['playlist' => $audio]);
    }

    public function user():Authenticatable{
        return Auth::guard("customers")->user();
    }

    public function playlist($broadcast_on){
        return $this->user()->playlist()->where('broadcast_on','=',$broadcast_on)->orderBy('broadcast_date','asc');
    }

}

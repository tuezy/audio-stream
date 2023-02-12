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
        return redirect()->to(route("home.sang"));
    }

    public function faq(Request $request){
        $cms = Cms::query()->where('visibility','=', 1)->select('title', 'content', 'short_content','slug')->paginate(15);
        return view("index.pages.cms.index",
            [
                'cms' => $cms
            ]
        );
    }

    public function faqItem($slug, Request $request){
        $item = Cms::query()->firstWhere('slug','=', $slug);
        return view("index.pages.cms.detail",
            [
                'item' => $item
            ]
        );
    }

    public function morning(Request $request){
        return $this->viewHome("phat-thanh-buoi-sang");
    }

    public function afternoon(Request $request){
        return $this->viewHome("phat-thanh-buoi-trua");
    }

    public function evening(Request $request){
        return $this->viewHome("phat-thanh-buoi-toi");
    }

    public function viewHome($broadcast_on){
        $cms = Cms::query()->where('visibility','=', 1)->select('title', 'content', 'short_content','slug')->limit(6)->get();
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

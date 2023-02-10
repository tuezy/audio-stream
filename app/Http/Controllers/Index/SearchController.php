<?php

namespace App\Http\Controllers\Index;

use App\Models\Audio;
use App\Models\Cms;
use App\Models\Customer;
use App\Models\Video;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SearchController extends IndexController
{

    public function __construct()
    {

    }

    public function search(Request $request){
        $input = $request->except('_token');

        $model = Audio::query();

        if($request->has('video')){
            $model = Video::query();
        }

        if($request->has('broadcast_on')){
            $model->where('broadcast_on' , '=', $request->get('broadcast_on'));
        }

        if($request->has('broadcast_date')){
            $model->where('broadcast_date' , '=', $request->get('broadcast_date'));
        }

        if($request->has('category_id')){
            $model->where('category_id' , '=', $request->get('category_id'));
        }

        if($request->has('title')){
            $model->where('title' , 'LIKE', '%'.$request->get('title').'%');
        }

        $cms = Cms::query()->where('visibility','=', 1)->select('title', 'content')->limit(6)->get();

        return view("index.pages.search.index", [
            'items' => $model->paginate(15),
            'cms' => $cms
        ]);

    }
}

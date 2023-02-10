<?php

namespace App\Http\Controllers\Index;

use App\Models\Cms;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class VideoController extends IndexController
{
    protected $user;

    public function __construct()
    {

    }

    public function index(Request $request){
        $cms = Cms::query()->select('title', 'content')->limit(6)->get();

        $videos = $this->currentUser()->video();

        if($request->has("category_id") && $request->get("category_id") > 0){
            $videos = $videos->where("category_id", "=", $request->get("category_id"));
        }

        if($request->has("title")){
            $videos = $videos->where("title", "LIKE", "%".$request->get("title")."%");
        }

        return view("index.pages.video.index", [
            'items' => $videos->paginate(15),
            'cms' => $cms
        ]);
    }

    public function slug($slug){
        $this->user = Auth::guard("customers")->user();
        $video = Video::findBySlug($slug);

        return view("index.pages.video.index", [
            'items' => $this->currentUser()->video()->paginate(15),
            'video' => $video
        ]);

    }


    public function delete($id){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                $videos = $this->videoRepository->whereIn('id', $ids)->get(['id', 'path']);

                foreach ($videos as $video){
                    Storage::delete($video->path);
                }
                Videos::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}

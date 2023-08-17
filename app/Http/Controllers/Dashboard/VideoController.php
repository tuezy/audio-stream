<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\Videos\VideoRepositoryContract;

use App\Datatables\VideoTables;
use App\Models\Video;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    protected $videos;

    protected $videoRepository;


    public function __construct(VideoRepositoryContract $videoRepository)
    {
        $this->middleware('auth');

        $this->videos = config('videos');
        $this->videoRepository = $videoRepository;


    }


    public function index(VideoTables $datatables){
        return $datatables->render("dashboard.pages.videos.index", [
            'entity' => "videos"
        ]);
    }

    public function create(Request $request){
        return view("dashboard.pages.videos.create");
    }

    public function store(Request $request){
        $input = $request->all();

        $rules = array(
            'title'  => 'required|string'
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }

        $this->videoRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = Video::with('category')->findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.videos.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.videos.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.videos.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = Video::find($id);

        $input = $request->except('_token');

        $rules = array(
                    'title'  => 'required|string'
                );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }
        $item->slug = null;
        $item->title = $input['title'];
        $item->category_id = $input['category_id'];

        $item->save();

        return redirect()->back()->with('success', __("dashboard.update-success"));
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

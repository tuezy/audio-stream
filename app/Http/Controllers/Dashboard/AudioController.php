<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\Audio\AudioRepositoryContract;

use App\Datatables\AudioTables;
use App\Models\Audio;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AudioController extends Controller
{
    protected $audio;

    protected $audioRepository;


    public function __construct(AudioRepositoryContract $audioRepository)
    {
        $this->middleware('auth');

        $this->audio = config('audio');
        $this->audioRepository = $audioRepository;


    }


    public function index(AudioTables $datatables){
            return $datatables->render("dashboard.pages.audio.index", [
                'entity' => "audio"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.audio.create");
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

        $this->audioRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = Audio::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.audio.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.audio.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.audio.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = Audio::find($id);

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

        $item->save();

        return redirect()->back()->with('success', __("dashboard.update-success"));
    }

    public function delete($id){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                Audio::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }
}

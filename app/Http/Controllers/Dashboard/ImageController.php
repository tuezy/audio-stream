<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Playlist;
use App\Repository\Images\imageRepositoryContract;

use App\Datatables\imageTables;
use App\Models\image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    protected $images;

    protected $imageRepository;


    public function __construct(imageRepositoryContract $imageRepository)
    {
        $this->middleware('auth');

        $this->images = config('images');
        $this->imageRepository = $imageRepository;


    }


    public function index($type){
        $item = $this->imageRepository->where('type', '=',$type)->first();
        return view("dashboard.pages.images.create", ['type' => $type, 'item' => $item]);
    }

    public function store($type, Request $request){
        $input = $request->all();

        $rules = array(
            'file' => 'required|image',
            'type'  => 'required|string'
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }

        $file = $request->file('file');
        $fileNameSaveAs = "storage/upload/images/". $type.'.'.$file->clientExtension();
        $path = $file->storeAs("public/upload/images", $type.'.'.$file->clientExtension());

        if( $path ) {
            $this->imageRepository->updateOrCreate([
                'type'  => $type,
            ],[
                'path' => $fileNameSaveAs,

            ]);
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }

        return redirect()->back()->with('success', "Create new success");

    }

}

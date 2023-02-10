<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Repository\Playlists\PlaylistRepositoryContract;

use App\Datatables\PlaylistTables;
use App\Models\Playlist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PlaylistController extends Controller
{
    protected $playlists;

    protected $playlistRepository;


    public function __construct(PlaylistRepositoryContract $playlistRepository)
    {
        $this->middleware('auth');

        $this->playlists = config('playlists');
        $this->playlistRepository = $playlistRepository;


    }


    public function index(PlaylistTables $datatables){
            return $datatables->render("dashboard.pages.playlists.index", [
                'entity' => "playlists"
            ]);
        }

    public function create(Request $request){
        return view("dashboard.pages.playlists.create");
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

        $this->playlistRepository->create([
                        'title' => $input['title']
        ]);

        return redirect()->back()->with('success', "Create new success");

    }
    public function edit($id){
        $item = Playlist::findOrFail($id);

        if(request()->ajax()){
            return view("dashboard.pages.playlists.modal.edit", [
                'item' => $item,
                'route' => route('dashboard.playlists.edit',['id' => $item->id])
            ]);
        }

        return view("dashboard.pages.playlists.edit", [
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $item = Playlist::find($id);

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

        return redirect()->back()->with('success', 'Item Updated');
    }

    public function delete($id){
        if(request()->has('ids')){
            $ids = request()->get('ids');
            try {
                Playlists::destroy($ids);
                return response()->json(['success' => true], 200);
            }catch (\Exception $exception){
                return $exception->getMessage();
            }
        }
    }


    public function make($id){
        Artisan::call("make:playlist ".$id);
        return redirect()->route('dashboard.playlist.index');
    }
}

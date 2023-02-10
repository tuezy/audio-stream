<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\FileRequest;
use App\Models\Audio;
use App\Models\Cms;
use App\Models\Playlist;
use App\Repository\Audio\AudioRepositoryContract;
use App\Repository\Playlists\PlaylistRepositoryContract;
use App\Repository\Videos\VideoRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomerController extends IndexController
{
    protected $videoRepository;
    protected $audioRepository;

    protected $playlistRepository;
    public function __construct(VideoRepositoryContract $videoRepository, AudioRepositoryContract $audioRepository, PlaylistRepositoryContract $playlistRepository)
    {
        $this->videoRepository = $videoRepository;
        $this->audioRepository = $audioRepository;
        $this->playlistRepository = $playlistRepository;
    }

    public function uploadAudio(Request $request){
        $input = $request->all();


        $rules = [
            'file' => 'required|mimes:mp3,avi,mp4,mpeg,mov',
            'title' => 'required',
            'broadcast_date' => 'required',
            'broadcast_on' => 'required'
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }

        $title = $input['title'];

        $description = $input['description'];

        $broadcast_date = $input['broadcast_date'];

        $broadcast_on = $input['broadcast_on'];

        $file = $request->file('file');


        $directory_save_as = implode('/', [
            "public",
            'users',
            Auth::guard("customers")->user()->id,
            'audios',
            $broadcast_date,
            $broadcast_on
        ]);

        $path = $file->store($directory_save_as);

        if($path){
            $path = Str::replace('public','storage', $path);
//            $directory = Str::replace('public/','storage/', $directory_save_as);
            $playlist = $this->playlistRepository->updateOrCreate([
                'broadcast_date' => $broadcast_date,
                'customer_id' => Auth::guard("customers")->user()->id,
                'broadcast_on' => $broadcast_on
            ],[
                'status' => Playlist::PLAYLIST_STATUS_PENDING,
                'folder' => $directory_save_as
            ]);

            if($playlist){
                $this->audioRepository->create([
                    'customer_id' => Auth::guard("customers")->user()->id,
                    'path' => $path,
                    'content' => $description,
                    'title' => $title,
                    'broadcast_date' => $broadcast_date,
                    'broadcast_on' => $broadcast_on,
                    'playlist_id' => $playlist->id
                ]);
            }

        }
        return redirect()->back();
    }

    public function uploadVideo(Request $request){
        $input = $request->all();

        $rules = [
            'file' => 'required|mimes:mp3,avi,mp4,mpeg,mov',
            'title' => 'required',
            'category_id'  => 'required'
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            return Response::make($validation->errors()->first(), 400);
        }

        $title = $input['title'];

        $category_id = $input['category_id'];

        $description = $input['description'];

        $file = $request->file('file');


        $directory_save_as = implode('/', [
            "public",
            'users',
            Auth::guard("customers")->user()->id,
            'videos',
            $category_id,
        ]);

        $path = $file->store($directory_save_as);

        if($path){
            $path = Str::replace('public','storage', $path);
            $this->videoRepository->create([
                'customer_id' => Auth::guard("customers")->user()->id,
                'path' => $path,
                'content' => $description,
                'category_id' => $category_id,
                'title' => $title
            ]);
        }
        return redirect()->back();
    }

    public function deleteAudio(){
        $id = request()->get('id');
        try {
            $audio  = Audio::where('customer_id', '=', Auth::guard("customers")->user()->id)->findOrFail($id);
            $path = $audio->path;
            $deleted = File::delete(storage_path('app/'.Str::replace('storage', 'public', $path)));
            if($deleted){
                $audio->delete();
                return response()->json(['success' => false], 200);
            }

            return response()->json(['success' => true], 200);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
    public function panel(Request $request){
        $today = date('d-m-Y', time());
        $playlist_status = [];
        foreach (Playlist::PLAYLIST_TYPES as $broadcast_on){
            $playlist = $this->playlistRepository
                ->where('broadcast_date', '=', $today)
                ->where('broadcast_on', '=', $broadcast_on)
                ->where('customer_id', '=', Auth::guard("customers")->user()->id)
                ->first();

            if($playlist){
                $playlist_status[$broadcast_on] = $playlist->status;
            }
        }



        return view("index.pages.customers.panel", [
            'user' => Auth::guard("customers")->user(),
            'playlist_status' => $playlist_status,
            'playlists' => Auth::guard("customers")->user()->playlist()->orderBy('broadcast_date', 'asc')->get()
        ]);
    }

    public function changePassword(Request $request){
        $input = $request->all();
    }

    public function makePlaylist($id){
        $user = Auth::guard("customers")->user();
        Artisan::call("make:playlist ".$id);
        return redirect()->back();
    }

    public function logout(Request $request){
        Auth::guard("customers")->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

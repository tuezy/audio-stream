<?php

namespace App\Http\Controllers\Index;

use App\Http\Requests\FileRequest;
use App\Models\Playlist;
use App\Repository\Playlists\PlaylistRepositoryContract;
use App\Repository\Settings\SettingRepositoryCache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class FIleController extends IndexController
{
    protected $playlistRepository;
    public function __construct(PlaylistRepositoryContract $playlistRepository)
    {
        $this->playlistRepository = $playlistRepository;
    }

    public function upload(FileRequest $fileRequest){

        $validated = $fileRequest->validated();

        if(Auth::guard('customers')->check()){
            $customer_id = Auth::guard('customers')->id();
        }
        $broadcast_date = $validated['broadcast_date'];
        $type = $validated['type'];

        $directory = 'upload/'. $customer_id . '/'. $broadcast_date .'/' . $type;

        $file = $fileRequest->file('file');

        $path = $file->store($directory);

        if( $path ) {
            $playlist = $this->playlistRepository->updateOrCreate([
                'broadcast_date' => $broadcast_date,
                'user_id' => $customer_id,
                'type'  => $type
            ],[
                'status' => Playlist::PLAYLIST_STATUS_PENDING,
                'folder' => $directory
            ]);



            $this->audioRepository->create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'broadcast_date' => $broadcast_date,
                'type'  => $type,
                'user_id' => $customer_id,
                'playlist_id' => $playlist->id
            ]);
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }

    }

}

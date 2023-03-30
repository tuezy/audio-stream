<?php

namespace App\Http\Controllers;

use App\Repository\Playlists\PlaylistRepositoryContract;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Carbon;

class PlayController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $playlistRepository;

    public function __construct(PlaylistRepositoryContract $playlistRepository)
    {
        $this->playlistRepository = $playlistRepository;
    }

    public function redirect($broadcast_on, $customer_id){
//        $broadcast_date = date('d-m-Y', time());
        $broadcast_date = date('Y-m-d', time());
        $playlist = $this->playlistRepository->where('broadcast_date', '=', $broadcast_date)
            ->where('broadcast_on', '=', $broadcast_on)
            ->where('customer_id', '=', $customer_id)
            ->first();
        if($playlist){
            return    redirect()->to($this->play($customer_id,$broadcast_date,$broadcast_on), 303);
        }
        abort(404);

    }

    public function play($customer_id,$broadcast_date,$broadcast_on){
        $realPath = "{$customer_id}/audios/{$broadcast_date}/{$broadcast_on}/{$broadcast_on}.m3u8";
        return route("play.playlist.m3u8", [
            'path' => $realPath
        ]);
    }
}

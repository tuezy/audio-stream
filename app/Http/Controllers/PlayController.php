<?php

namespace App\Http\Controllers;

use App\Repository\Playlists\PlaylistRepositoryContract;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PlayController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $playlistRepository;

    public function __construct(PlaylistRepositoryContract $playlistRepository)
    {
        $this->playlistRepository = $playlistRepository;
    }

    public function play($broadcast_on, $customer_id){
        $broadcast_date = date('d-m-Y', time());

        $playlist = $this->playlistRepository->where('broadcast_date', '=', $broadcast_date)
            ->where('broadcast_on', '=', $broadcast_on)
            ->where('customer_id', '=', $customer_id)
            ->first();

        if($playlist){
            redirect()->to("http://45.76.204.156:88/hls/public/users/{$customer_id}/audios/{$broadcast_date}/{$broadcast_on}/{$broadcast_on}.m3u8", 303);
        }
        abort(404);

    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class LinkStatus extends Component
{
    public $routeName;
    public $playlist_type;

    public $playlist_status;
    public $currentUrl;

    public $linkM3u8;

    public function mount()
    {
        $this->currentUrl = Route::currentRouteName();

        $this->linkM3u8 = implode('/',[
            'hls',
            'audio',
            $this->mappingBroadcastLink($this->currentUrl),
            \Illuminate\Support\Facades\Auth::guard("customers")->user()->id,
            'playlist.m3u8'
        ]);

        $today = date('Y-m-d', time());
        $playlist = Playlist::where('broadcast_date', '=', $today)
            ->where('broadcast_on', '=', $this->mappingBroadcastLink($this->currentUrl))
            ->where('customer_id', '=', Auth::guard("customers")->user()->id)
            ->first();

        if($playlist){
            $this->playlist_status = $playlist->status == 'completed' ? 'Sẵn sàng' : 'Chưa sẵn sàng';
        }
    }
    public function render()
    {
        return view('livewire.link-status');
    }

    protected function mappingBroadcastLink($type){
        switch ($type){
            case 'home.sang':
                return 'phat-thanh-buoi-sang';
                break;
            case 'home.toi':
            return 'phat-thanh-buoi-toi';
            break;
            case 'home.trua':
                return 'phat-thanh-buoi-trua';
                break;
        }
        return '';
    }
}

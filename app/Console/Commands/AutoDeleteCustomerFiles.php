<?php

namespace App\Console\Commands;

use App\Repository\Audio\AudioRepositoryContract;
use App\Repository\Playlists\PlaylistRepositoryContract;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class AutoDeleteCustomerFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customers:autoDeleteFiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $playlist;

    protected $audio;

    public function __construct(PlaylistRepositoryContract $playlist, AudioRepositoryContract $audio)
    {
        parent::__construct();
        $this->playlist = $playlist;
        $this->audio = $audio;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $days = core()->getSetting('auto_delete_after', 7);

        $date = Carbon::now()->subDays(1)->format("d-m-Y");

        $playlists = $this->playlist->where('broadcast_date', '<=', $date)->get();

        foreach ($playlists as $playlist){
           foreach ($playlist->audio() as $audio){
               $audio->delete();
           }
            File::deleteDirectory(storage_path('app/public/hls/public/users/'.$playlist->customer_id.'/audios/'.$playlist->broadcast_date), true);
            File::deleteDirectory(storage_path('app/public/users/'.$playlist->customer_id.'/audios/'.$playlist->broadcast_date), true);
            $playlist->delete();
        }

    }
}

<?php

namespace App\Console\Commands;

use App\Models\Playlist;
use App\Repository\Audio\AudioRepositoryContract;
use App\Repository\Playlists\PlaylistRepositoryContract;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class MakePlaylist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:playlist {id}';

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

    protected $playlistRepository;

    protected $audioRepository;

    public function __construct(PlaylistRepositoryContract $playlistRepository, AudioRepositoryContract $audioRepository)
    {
        parent::__construct();
        $this->playlistRepository = $playlistRepository;
        $this->audioRepository = $audioRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $playlist = $this->playlistRepository
            ->getModel()
            ->with("audio")
            ->findOrFail($this->argument('id'));
        if(count($playlist->audio) > 0){
            $hlsDir = storage_path('app/public/hls/' . $playlist->folder);
            if(File::exists($hlsDir) || is_dir($hlsDir)){
                File::deleteDirectory($hlsDir, true);
            }
            File::ensureDirectoryExists($hlsDir, 0777, true);


            $cmd = 'ffmpeg ';

            $audios = $this->audioRepository->where('playlist_id', '=', $playlist->id)->orderBy("index", "asc")->get();

            foreach ($audios as $audio){
                $cmd .= ' -i ' . storage_path('app/'. Str::replace('storage', 'public', $audio->path));
            }
            $cmd .= ' -filter_complex \'[0:a][1:a]concat=n='.count($playlist->audio).':v=0:a=1[out]\' -map \'[out]\' -c:a aac -b:a 128k -start_number 0 -hls_time 10 -hls_list_size 0 -f hls ';

            $cmd .= $hlsDir . DIRECTORY_SEPARATOR .$playlist->broadcast_on .'.m3u8';

            $this->info($cmd);
            Log::debug($cmd);

            $process = Process::fromShellCommandline($cmd);

            $process->setTimeout(null);
            $process->setIdleTimeout(null);

            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $playlist->status = Playlist::PLAYLIST_STATUS_COMPLETED;

            $playlist->save();
        }
    }
}

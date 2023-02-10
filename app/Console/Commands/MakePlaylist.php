<?php

namespace App\Console\Commands;

use App\Models\Playlist;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
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

    public function __construct(PlaylistRepository $playlistRepository)
    {
        parent::__construct();
        $this->playlistRepository = $playlistRepository;
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
            ->with("audio")->findOrFail($this->argument('id'));
        if(count($playlist->audio) > 0){
            $hlsDir = storage_path('app/public/hls/' . $playlist->folder);
            if(File::exists($hlsDir)){
                File::deleteDirectory($hlsDir);
            }
            File::makeDirectory($hlsDir, 0777, true);

            $cmd = 'ffmpeg ';
            foreach ($playlist->audio as $audio){
                $cmd .= ' -i ' . storage_path('app/'.$audio->path);
            }
            $cmd .= ' -filter_complex \'[0:0][1:0]concat=n='.count($playlist->audio).':v=0:a=1[out]\' -map \'[out]\' -vn -ac 2 -acodec aac -start_number 0 -hls_time 10 -hls_list_size 0 -f hls ';

            $cmd .= $hlsDir . DIRECTORY_SEPARATOR .$playlist->type .'.m3u8';
            $this->info($cmd);
            $process = Process::fromShellCommandline($cmd);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $playlist->status = Playlist::PLAYLIST_STATUS_COMPLETED;
            $playlist->save();
        }
    }
}

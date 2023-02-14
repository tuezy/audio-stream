<?php

namespace App\Jobs;

use App\Models\Playlist;
use App\Repository\Audio\AudioRepositoryContract;
use App\Repository\Playlists\PlaylistRepositoryContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ConvertAudioToM3u8 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $playlistRepository;

    protected $audioRepository;

    protected $playlist;

    public function __construct($playlist)
    {
        $this->playlistRepository = app()->make(PlaylistRepositoryContract::class);
        $this->audioRepository =  app()->make(AudioRepositoryContract::class);
        $this->playlist = $playlist;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $playlist = $this->playlist;

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
            $cmd .= ' -filter_complex \'[0:0][1:0]concat=n='.count($playlist->audio).':v=0:a=1[out]\' -map \'[out]\' -vn -ac 2 -acodec aac -start_number 0 -hls_time 10 -hls_list_size 0 -f hls ';

            $cmd .= $hlsDir . DIRECTORY_SEPARATOR .$playlist->broadcast_on .'.m3u8';

            $this->info($cmd);

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

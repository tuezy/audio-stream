<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NewLiveChannel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:channel {name : Class (singular)} {--m} {--force}';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        File::ensureDirectoryExists(storage_path("nginx"), 0777);
        File::ensureDirectoryExists(storage_path("live-stream/$name"), 0777);
        $phpFile = storage_path("nginx/$name.conf");

        file_put_contents($phpFile, $this->replace($name));

        if(File::exists($phpFile)){
            Artisan::call("nginx:reload");
        }
    }

    protected function replace($name){
        return str_replace(
            [
                '{{modelName}}',
                '{{serverPath}}',
                 '{{on_publish}}',
                 '{{on_done}}'
            ],
            [
                $name,
                storage_path("live-stream/$name"),
                route("api.livestream.publish"),
                route("api.livestream.done_livestream"),
            ],
            $this->getStub()
        );
    }

    protected function getStub()
    {
        return file_get_contents(app_path("Console/Commands/stub/nginx/channel.stub"));
    }
}

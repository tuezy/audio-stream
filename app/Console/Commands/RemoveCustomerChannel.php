<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class RemoveCustomerChannel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:channel {name : Class (singular)} {--m} {--force}';

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
        $phpFile = storage_path("livestream/$name.conf");



        if(File::exists($phpFile)){
            File::delete($phpFile);
        }

        if(!File::exists($phpFile)){
            Artisan::call("nginx:reload");
        }

        File::deleteDirectory(storage_path("live-stream/$name"));

    }
}

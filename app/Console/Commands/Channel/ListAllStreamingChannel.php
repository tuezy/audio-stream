<?php

namespace App\Console\Commands\Channel;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class ListAllStreamingChannel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'channel:list-all-streaming';

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
        $allChannels = (new Finder())->in(storage_path("live-stream"))->files()->name("index.m3u8");
        if($allChannels->count()){
            foreach ($allChannels as $channel){
                $this->info($channel->getRelativePathname());
            }
        }
    }
}

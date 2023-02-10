<?php

namespace Database\Seeders;

use App\Models\Cms;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class CmsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Cache::flush();
        Cms::factory()->count(20)->create();
    }
}

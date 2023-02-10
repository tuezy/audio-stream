<?php

namespace Database\Seeders;

use App\Models\Cms;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class CustomerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Cache::flush();
        Customer::factory()->count(20)->create();
    }
}

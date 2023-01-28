<?php

namespace Database\Seeders;

use App\Repository\Developments\DevelopmentContract;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    protected $dev;
    public function __construct(DevelopmentContract $dev)
    {
        $this->dev = $dev;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();
        $now = Carbon::now();
        $stt = 0;
        foreach (config('settings') as $group => $settings){
            foreach ($settings as $setting){
                DB::table('settings')->insert([
                    'id'            => ++$stt,
                    'title'         => __($setting['title']),
                    'key'           => $setting['key'],
                    'value'         => $setting['value'],
                    'type'          => $setting['type'],
                    'validation'    => $setting['validation'] ?? null,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ]);
            }
        }
    }
}

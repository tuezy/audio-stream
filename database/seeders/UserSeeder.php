<?php

namespace Database\Seeders;

use App\Repository\Developments\DevelopmentContract;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserSeeder extends Seeder
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
        DB::table('users')->delete();
        $now = Carbon::now();
        $stt = 0;

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at'=> $now,
            'created_at' => $now,
            'updated_at'    => $now,
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'mod',
            'email' => 'mod@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at'=> $now,
            'created_at' => $now,
            'updated_at'    => $now,
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'member',
            'email' => 'member@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at'=> $now,
            'created_at' => $now,
            'updated_at'    => $now,
        ]);


    }
}

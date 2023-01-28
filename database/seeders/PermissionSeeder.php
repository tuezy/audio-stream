<?php

namespace Database\Seeders;

use App\Repository\Developments\DevelopmentContract;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class PermissionSeeder extends Seeder
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
        $routes = Collection::make(Route::getRoutes()->getRoutesByName())
            ->filter(function (\Illuminate\Routing\Route $route) {
                return strpos($route->getName(), 'dashboard.') === 0;
            });
        DB::table('permissions')->delete();
        $now = Carbon::now();
        $stt = 0;
        foreach ($routes as $route){
            $name = $route->getName();
            $group = explode('.', $name);
            DB::table('permissions')->insert([
                'id'            => ++$stt,
                'title'         => $route->defaults['_config']['permission_title'],
                'code'           => $route->getName(),
                'route'         => $route->getName(),
                'group'         => $group[1],
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);
        }
    }
}

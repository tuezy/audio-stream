<?php

namespace App\Console\Commands;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class ReloadPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:reload-dashboard';

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
        $roles = Role::with('permissions')->get();

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

        //restore old permission

        foreach ($roles as $role){
            if($role->permissions->isEmpty()) continue;
            foreach ($role->permissions as $permission){
                $role->permissions()->attach($permission);
            }

        }
    }
}

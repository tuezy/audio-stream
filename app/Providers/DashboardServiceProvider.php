<?php

namespace App\Providers;

use App\Helpers\Core as CoreHelper;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->initSettingsPage();
    }

    public function initSettingsPage(){

        if(!Cache::has("settings") && Schema::hasTable("settings")){
            Cache::rememberForever('settings', function (){
                $db =  DB::table("settings")->get(['key','value']);
                $result = [];
                foreach ($db as $item){
                    $result[$item->key] = $item->value;
                }
                return $result;
            });
        }
    }
}

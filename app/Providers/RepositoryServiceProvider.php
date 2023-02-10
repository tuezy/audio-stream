<?php

namespace App\Providers;

use App\Repository\categories\CategoryRepositoryCache;
use App\Repository\Categories\CategoryRepositoryContract;
use App\Repository\Developments\DevelopmentContract;
use App\Repository\Developments\DevelopmentRepositoryCache;
use App\Repository\Playlists\PlaylistRepository;
use App\Repository\Playlists\PlaylistRepositoryCache;
use App\Repository\Playlists\PlaylistRepositoryContract;
use App\Repository\Settings\SettingRepositoryCache;
use App\Repository\Settings\SettingRepositoryContract;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $mapper = json_decode(file_get_contents(base_path('metadata.json')), true);
        foreach ($mapper as $key => $value){
            $this->app->singleton($key, $value);
        }
        $this->app->singleton(SettingRepositoryContract::class, SettingRepositoryCache::class);
        $this->app->singleton(DevelopmentContract::class, DevelopmentRepositoryCache::class);
        $this->app->singleton(CategoryRepositoryContract::class, CategoryRepositoryCache::class);
//        $this->app->singleton(PlaylistRepositoryContract::class, PlaylistRepositoryCache::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Repository\Developments\DevelopmentContract;
use App\Repository\Developments\DevelopmentRepositoryCache;
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
        $this->app->singleton(SettingRepositoryContract::class, SettingRepositoryCache::class);
        $this->app->singleton(DevelopmentContract::class, DevelopmentRepositoryCache::class);
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

<?php

namespace App\Providers;

use App\Helpers\Core as CoreHelper;
use App\Helpers\Services\Acl\Bouncer;
use App\Modules\Datatables\Providers\DatatablesServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        include app_path("Helpers/functions.php");

        $this->app->bind('core', function()
        {
            return new CoreHelper;
        });

        $this->app->bind('bouncer', function()
        {
            return new Bouncer;
        });
        $this->app->registerDeferredProvider(DatatablesServiceProvider::class);
        $this->app->registerDeferredProvider(RepositoryServiceProvider::class);
        $this->app->registerDeferredProvider(DashboardServiceProvider::class);
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

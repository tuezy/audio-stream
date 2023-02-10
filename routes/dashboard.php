<?php

use \Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\SettingController;
use \App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CmsController;
use \App\Http\Controllers\Dashboard\CustomerController;

Route::name('dashboard.')
    ->prefix('dashboard')
    ->group(function (){
        Route::get('/', [\App\Http\Controllers\Dashboard\IndexController::class, 'index'])->defaults('_config', [
            'permission_title' => 'View Dashboard'
        ])->name('index');

        Route::get('/asset/{type}', [\App\Http\Controllers\Dashboard\ImageController::class, 'index'])->defaults('_config', [
            'permission_title' => 'Change Image'
        ])->name('images.index');
        Route::put('/asset/{type}', [\App\Http\Controllers\Dashboard\ImageController::class, 'store'])->name('images.store');

        Route::get('/login', [\App\Http\Controllers\Dashboard\AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [\App\Http\Controllers\Dashboard\AuthController::class, 'login']);
        Route::post('/logout', [\App\Http\Controllers\Dashboard\AuthController::class, 'logout'])->name('logout');

        Route::get('roles', [\App\Http\Controllers\Dashboard\RoleController::class, "index"])
            ->defaults('_config', [
                'permission_title' => 'View Roles'
            ])->name('roles.index');

        Route::get('roles/edit/{id}', [RoleController::class, "edit"])
            ->defaults('_config', [
                'permission_title' => 'Edit Roles'
            ])->name('roles.edit');

        Route::post('roles/edit/{id}', [RoleController::class, "update"])
            ->defaults('_config', [
                'permission_title' => 'Update Roles'
            ])->name('roles.update');

        Route::put('roles', [RoleController::class, "store"])
            ->defaults('_config', [
                'permission_title' => 'Store Roles'
            ])->name('roles.store');

        Route::delete('roles', [RoleController::class, "delete"])
            ->defaults('_config', [
                'permission_title' => 'Delete Roles'
            ])->name('roles.delete');

        /*
         * Users
         */


        Route::get('users', [UserController::class, "index"])
            ->defaults('_config', [
                'permission_title' => 'View Users'
            ])->name('users.index');

        Route::put('users', [UserController::class, "store"])
            ->defaults('_config', [
                'permission_title' => 'Store Users'
            ])->name('users.store');

        Route::get('users/edit/{id}', [UserController::class, "edit"])
            ->defaults('_config', [
                'permission_title' => 'Edit Users'
            ])->name('users.edit');

        Route::post('users/edit/{id}', [UserController::class, "update"])
            ->defaults('_config', [
                'permission_title' => 'Update Users'
            ])->name('users.update');

        Route::delete('users', [UserController::class, "delete"])
            ->defaults('_config', [
                'permission_title' => 'Delete Users'
            ])->name('users.delete');


        Route::get('customers', [CustomerController::class, "index"])
            ->defaults('_config', [
                'permission_title' => 'View Customers'
            ])->name('customers.index');

        Route::put('customers', [CustomerController::class, "store"])
            ->defaults('_config', [
                'permission_title' => 'Store Customers'
            ])->name('customers.store');

        Route::get('customers/edit/{id}', [CustomerController::class, "edit"])
            ->defaults('_config', [
                'permission_title' => 'Edit Customers'
            ])->name('customers.edit');

        Route::post('customers/edit/{id}', [CustomerController::class, "update"])
            ->defaults('_config', [
                'permission_title' => 'Update Customers'
            ])->name('customers.update');

        Route::delete('customers', [CustomerController::class, "delete"])
            ->defaults('_config', [
                'permission_title' => 'Delete Customers'
            ])->name('customers.delete');

        /*
         * Settings
         */
        Route::get('settings', [SettingController::class, "index"])
            ->defaults('_config', [
                'permission_title' => 'View Settings'
            ])->name('settings.index');

        Route::post('settings', [SettingController::class, "store"])
            ->defaults('_config', [
                'permission_title' => 'Update Settings'
            ])->name('settings.store');

        /*
         * Cms
         */


        Route::get('cms', [CmsController::class, "index"])
            ->defaults('_config', [
                'permission_title' => 'View CMS'
            ])->name('cms.index');

        Route::get('cms/create', [CmsController::class, "create"])
            ->defaults('_config', [
                'permission_title' => 'Create CMS'
            ])->name('cms.create');

        Route::put('cms', [CmsController::class, "store"])
            ->defaults('_config', [
                'permission_title' => 'Store CMS'
            ])->name('cms.store');

        Route::get('cms/edit/{id}', [CmsController::class, "edit"])
            ->defaults('_config', [
                'permission_title' => 'Edit CMS'
            ])->name('cms.edit');

        Route::put('cms/edit/{id}', [CmsController::class, "update"])
            ->defaults('_config', [
                'permission_title' => 'Update CMS'
            ])->name('cms.update');

        Route::delete('cms', [CmsController::class, "delete"])
            ->defaults('_config', [
                'permission_title' => 'Delete CMS'
            ])->name('cms.delete');

        Route::get('/playlist/make/{id}', [PlaylistController::class, 'make'])->name('make.playlist');

        foreach ([
            'category',
            'video',
            'audio',
            'playlist'
                 ] as $keytmp){
            $key = \Illuminate\Support\Str::plural($keytmp);
                Route::controller("\\App\\Http\\Controllers\\Dashboard\\".ucfirst($keytmp)."Controller")->group(function() use($key){
                    Route::get($key,'index')
                        ->defaults('_config', [
                            'permission_title' => 'View '. ucfirst($key)
                        ])->name($key.'.index');

                    Route::get($key.'/create', 'create')
                        ->defaults('_config', [
                            'permission_title' => 'Create '. ucfirst($key)
                        ])->name($key.'.create');

                    Route::put($key, 'store')
                        ->defaults('_config', [
                            'permission_title' => 'Store '. ucfirst($key)
                        ])->name($key.'.store');

                    Route::get($key.'/edit/{id}', 'edit')
                        ->defaults('_config', [
                            'permission_title' => 'Edit '. ucfirst($key)
                        ])->name($key.'.edit');

                    Route::post($key.'/edit/{id}', 'update')
                        ->defaults('_config', [
                            'permission_title' => 'Update '. ucfirst($key)
                        ])->name($key.'.update');

                    Route::delete($key, 'delete')
                        ->defaults('_config', [
                            'permission_title' => 'Delete '. ucfirst($key)
                        ])->name($key.'.delete');
                });
        }

    });

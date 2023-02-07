<?php

use \Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\SettingController;
use \App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CmsController;

Route::name('dashboard.')
    ->prefix('dashboard')
    ->group(function (){
        Route::get('/', [\App\Http\Controllers\Dashboard\IndexController::class, 'index'])->defaults('_config', [
            'permission_title' => 'View Dashboard'
        ])->name('index');

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

        Route::post('cms/edit/{id}', [CmsController::class, "update"])
            ->defaults('_config', [
                'permission_title' => 'Update CMS'
            ])->name('cms.update');

        Route::delete('cms', [CmsController::class, "delete"])
            ->defaults('_config', [
                'permission_title' => 'Delete CMS'
            ])->name('cms.delete');


    });

<?php

use \Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\SettingController;
use \App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
Route::name('dashboard.')
    ->prefix('dashboard')
    ->group(function (){

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


        Route::get('settings', [SettingController::class, "index"])
            ->defaults('_config', [
                'permission_title' => 'View Settings'
            ])->name('settings.index');

        Route::post('settings', [SettingController::class, "store"])
            ->defaults('_config', [
                'permission_title' => 'Update Settings'
            ])->name('settings.store');

});

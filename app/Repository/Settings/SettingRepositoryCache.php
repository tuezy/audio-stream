<?php
namespace App\Repository\Settings;

use App\Helpers\Repository\RepositoryCache;

class SettingRepositoryCache extends RepositoryCache implements SettingRepositoryContract {

    public function repository(): string
    {
        return SettingRepository::class;
    }
}

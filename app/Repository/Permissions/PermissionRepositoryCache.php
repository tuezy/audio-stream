<?php
namespace App\Repository\Permissions;

use App\Helpers\Repository\RepositoryCache;

class PermissionRepositoryCache extends RepositoryCache implements PermissionRepositoryContract{

    public function repository(): string
    {
        return PermissionRepository::class;
    }
}

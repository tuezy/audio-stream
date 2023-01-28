<?php
namespace App\Repository\Permissions;

use App\Helpers\Repository\Repository;
use App\Models\Permission;
use App\Models\Setting;

class PermissionRepository extends Repository implements PermissionRepositoryContract {

    public function model(): string
    {
        return Permission::class;
    }
}

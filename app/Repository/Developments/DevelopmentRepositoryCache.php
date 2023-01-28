<?php
namespace App\Repository\Developments;

use App\Helpers\Repository\RepositoryCache;

class DevelopmentRepositoryCache extends RepositoryCache implements DevelopmentContract{

    public function repository(): string
    {
        return DevelopmentRepository::class;
    }
}

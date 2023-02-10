<?php
namespace App\Repository\categories;

use App\Helpers\Repository\RepositoryCache;

class CategoryRepositoryCache extends RepositoryCache implements CategoryRepositoryContract{

    public function repository(): string
    {
        return CategoryRepository::class;
    }
}

<?php
namespace App\Repository\Categories;

use App\Helpers\Repository\RepositoryCache;

class CategoryRepositoryCache extends RepositoryCache implements CategoryRepositoryContract{

    public function repository(): string
    {
        return CategoryRepository::class;
    }
}

<?php
namespace App\Repository\categories;

use App\Helpers\Repository\Repository;
use App\Models\Category;

class CategoryRepository extends Repository implements CategoryRepositoryContract{

    public function model(): string
    {
        return Category::class;
    }
}

<?php
namespace App\Repository\images;

use App\Helpers\Repository\Repository;
use App\Models\Image;

class ImageRepository extends Repository implements ImageRepositoryContract{

    public function model(): string
    {
        return Image::class;
    }
}

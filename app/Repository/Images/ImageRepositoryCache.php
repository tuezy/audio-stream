<?php
namespace App\Repository\Images;

use App\Helpers\Repository\RepositoryCache;

class ImageRepositoryCache extends RepositoryCache implements ImageRepositoryContract{

    public function repository(): string
    {
        return ImageRepository::class;
    }
}

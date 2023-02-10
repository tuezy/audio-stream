<?php
namespace App\Repository\Videos;

use App\Helpers\Repository\RepositoryCache;

class VideoRepositoryCache extends RepositoryCache implements VideoRepositoryContract{

    public function repository(): string
    {
        return VideoRepository::class;
    }
}

<?php
namespace App\Repository\films;

use App\Helpers\Repository\RepositoryCache;

class FilmRepositoryCache extends RepositoryCache implements FilmRepositoryContract{

    public function repository(): string
    {
        return FilmRepository::class;
    }
}

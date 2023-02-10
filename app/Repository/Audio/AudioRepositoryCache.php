<?php
namespace App\Repository\audio;

use App\Helpers\Repository\RepositoryCache;

class AudioRepositoryCache extends RepositoryCache implements AudioRepositoryContract{

    public function repository(): string
    {
        return AudioRepository::class;
    }
}

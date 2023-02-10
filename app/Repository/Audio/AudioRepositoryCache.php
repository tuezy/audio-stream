<?php
namespace App\Repository\Audio;

use App\Helpers\Repository\RepositoryCache;

class AudioRepositoryCache extends RepositoryCache implements AudioRepositoryContract{

    public function repository(): string
    {
        return AudioRepository::class;
    }
}

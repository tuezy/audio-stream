<?php
namespace App\Repository\playlists;

use App\Helpers\Repository\RepositoryCache;

class PlaylistRepositoryCache extends RepositoryCache implements PlaylistRepositoryContract{

    public function repository(): string
    {
        return PlaylistRepository::class;
    }
}

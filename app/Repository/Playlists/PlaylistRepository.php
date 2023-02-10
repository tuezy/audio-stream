<?php
namespace App\Repository\playlists;

use App\Helpers\Repository\Repository;
use App\Models\Playlist;

class PlaylistRepository extends Repository implements PlaylistRepositoryContract{

    public function model(): string
    {
        return Playlist::class;
    }
}

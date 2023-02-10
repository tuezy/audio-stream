<?php
namespace App\Repository\Playlists;

use App\Helpers\Repository\Repository;
use App\Models\Playlist;

class PlaylistRepository extends Repository implements PlaylistRepositoryContract{

    public function model(): string
    {
        return Playlist::class;
    }
}

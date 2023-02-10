<?php
namespace App\Repository\videos;

use App\Helpers\Repository\Repository;
use App\Models\Video;

class VideoRepository extends Repository implements VideoRepositoryContract{

    public function model(): string
    {
        return Video::class;
    }
}

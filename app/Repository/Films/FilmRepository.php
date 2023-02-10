<?php
namespace App\Repository\films;

use App\Helpers\Repository\Repository;
use App\Models\Film;

class FilmRepository extends Repository implements FilmRepositoryContract{

    public function model(): string
    {
        return Film::class;
    }
}

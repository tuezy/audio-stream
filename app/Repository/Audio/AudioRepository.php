<?php
namespace App\Repository\audio;

use App\Helpers\Repository\Repository;
use App\Models\Audio;

class AudioRepository extends Repository implements AudioRepositoryContract{

    public function model(): string
    {
        return Audio::class;
    }
}

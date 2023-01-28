<?php
namespace App\Repository\Developments;

use App\Helpers\Repository\Repository;
use App\Models\Development;

class DevelopmentRepository extends Repository implements DevelopmentContract{

    public function model(): string
    {
        return Development::class;
    }
}

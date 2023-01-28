<?php
namespace App\Helpers\Repository;

use Illuminate\Database\Eloquent\Model;

interface RepositoryContract{
    public function model():string;
    public function getModel(): Model;
    public function with(array $with = []);
    public function applyConditions(array $where, &$model = null);
    public function all($columns = ["*"], array $with = []);
    public function updateOrCreate($condition, $value);

}

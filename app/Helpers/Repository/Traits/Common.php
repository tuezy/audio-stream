<?php
namespace App\Helpers\Repository\Traits;

trait Common{
    public function all($columns = ["*"], array $with = []){
        return $this->applyBeforeExecuteQuery(
            $this->with($with)
        )->get($columns);
    }
    public function updateOrCreate($condition, $value){
        return $this->getModel()->updateOrCreate($condition, $value);
    }
}

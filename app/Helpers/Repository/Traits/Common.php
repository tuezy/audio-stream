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

    public function create($data){
        return $this->getModel()->create($data);
    }

    public function whereIn($field, $data){
        return $this->getModel()->whereIn($field, $data);
    }

    public function whereNotIn($field, $data){
        return $this->getModel()->whereNotIn($field, $data);
    }

    public function where($column, $operator, $value){
        return $this->getModel()->where($column, $operator, $value);
    }
}

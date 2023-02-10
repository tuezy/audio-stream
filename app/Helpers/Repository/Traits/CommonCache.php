<?php
namespace App\Helpers\Repository\Traits;

trait CommonCache{
    public function all($columns = ["*"], array $with = []){
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    public function updateOrCreate($condition, $value){
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    public function create($data){
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    public function whereIn($fied, $data){
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    public function whereNotIn($field, $data){
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    public function where($column, $operator, $value){
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

}

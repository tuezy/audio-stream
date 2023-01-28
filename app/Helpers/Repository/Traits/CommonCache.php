<?php
namespace App\Helpers\Repository\Traits;

trait CommonCache{
    public function all($columns = ["*"], array $with = []){
        return $this->getDataIfExistCache(__FUNCTION__, func_get_args());
    }

    public function updateOrCreate($condition, $value){
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}

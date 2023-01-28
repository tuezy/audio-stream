<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
    ];

    public function permissions() {

        return $this->belongsToMany(Permission::class,'roles_permissions');

    }

    public function users() {

        return $this->belongsToMany(User::class,'users_roles');

    }

    public function hasPermission(string $route){
        $result = $this->permissions->filter(function ($value) use($route){
            return $value->route == $route;
        });
        if($result->first()){
            return true;
        }
        return false;
    }
}

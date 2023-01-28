<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'title',
        'route',
    ];

    public function roles() {

        return $this->belongsToMany(Role::class,'roles_permissions');

    }

    public function users() {
        return $this->belongsToMany(User::class,'users_permissions');
    }

    public function hasPermission(){
        $currentRoute = Route::currentRouteName();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Image extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['path','type', 'status','index'];

}

<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cms extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    protected $fillable = [
        'index',
        'title',
        'short_content',
        'content',
        'slug',
        'visibility'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

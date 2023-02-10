<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    protected $fillable = ['title','status','index'];

    /**
         * Return the sluggable configuration array for this model.
         *
         * @return array
         */
        public function sluggable(): array
        {
            return [
                'slug' => [
                    'source' => 'title'
                ]
            ];
        }

        public function video(){
            $this->hasMany(Video::class);
        }
}

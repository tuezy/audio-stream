<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Video extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable, SluggableScopeHelpers;

    protected $fillable = ['title','path', 'content', 'status', 'index', 'category_id', 'customer_id'];

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

        public function category(){
            return $this->belongsTo(Category::class);
        }

        public function customer(){
            return $this->belongsTo(Customer::class);
        }
}

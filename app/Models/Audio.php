<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Audio extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    protected $fillable = ['path', 'title','visibility', 'status','index', 'broadcast_date', 'broadcast_on', 'playlist_id', 'customer_id'];

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

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function playlist(){
        return $this->belongsTo(Playlist::class);
    }
}

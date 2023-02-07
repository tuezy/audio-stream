<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Audio extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = ['name', 'path', 'playlist_id', 'type', 'broadcast_date','user_id'];

    public function playlist(){
        return $this->belongsTo(Playlist::class);
    }
}

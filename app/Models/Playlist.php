<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;


    public const PLAYLIST_TYPE_MORNING = 'morning';

    public const PLAYLIST_TYPE_AFTERNOON = 'afternoon';

    public const PLAYLIST_TYPE_EVENING = 'evening';

    public const PLAYLIST_STATUS_PENDING = 'pending';

    public const PLAYLIST_STATUS_PROCESSING = 'PROCESSING';

    public const PLAYLIST_STATUS_COMPLETED = 'completed';

    protected $fillable = ['folder','type', 'broadcast_date','user_id', 'status'];

    public function audio(){
        return $this->hasMany(Audio::class);
    }
}

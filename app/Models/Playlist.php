<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;


    public const PLAYLIST_TYPE_MORNING = 'phat-thanh-buoi-sang';

    public const PLAYLIST_TYPE_AFTERNOON = 'phat-thanh-buoi-trua';

    public const PLAYLIST_TYPE_EVENING = 'phat-thanh-buoi-toi';

    public const PLAYLIST_TYPES = [
        'morning' => self::PLAYLIST_TYPE_MORNING,
        'afternoon' => self::PLAYLIST_TYPE_AFTERNOON,
        'evening'   => self::PLAYLIST_TYPE_EVENING
    ];

    public const PLAYLIST_TYPES_TRANSLATION = [
        self::PLAYLIST_TYPE_MORNING => "Buổi sáng",
        self::PLAYLIST_TYPE_AFTERNOON => "Buổi trưa",
        self::PLAYLIST_TYPE_EVENING  => "Buổi tối"
    ];

    public const PLAYLIST_STATUS_PENDING = 'pending';

    public const PLAYLIST_STATUS_PROCESSING = 'processing';

    public const PLAYLIST_STATUS_COMPLETED = 'completed';

    protected $fillable = ['folder','broadcast_on', 'broadcast_date','customer_id', 'status'];

    public function audio(){
        return $this->hasMany(Audio::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}

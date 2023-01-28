<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public const TYPE_BOOLEAN = 'boolean';

    public const TYPE_TEXT = 'text';

    public const TYPE_INTEGER = 'integer';

    public const TYPE_DOUBLE = 'double';

    public const TYPE_TEXTAREA = 'textarea';

    protected $fillable = [
        'title',
        'key',
        'value',
        'type',
        'validation'
    ];
}

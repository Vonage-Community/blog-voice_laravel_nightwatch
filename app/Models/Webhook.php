<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    protected $fillable = [
        'channel',
        'message_uuid',
        'to',
        'from',
        'timestamp',
        'context_status',
        'message_type',
        'text',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];
}

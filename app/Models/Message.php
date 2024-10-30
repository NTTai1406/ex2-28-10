<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=[
        'channel_id',
        'message',
        'user_id',
    ];
}

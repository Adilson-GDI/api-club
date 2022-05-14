<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Clubecasa\Events\BroadcastChat;

class Chat extends Model
{
    protected $dispatchesEvents = [
        'created' => BroadcastChat::class
    ];

    protected $fillable = [
    	'user_id',
    	'friend_id',
    	'chat'
    ];
}

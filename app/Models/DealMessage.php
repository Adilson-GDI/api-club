<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Clubecasa\Events\BroadcastDealMessage;
//use Illuminate\Notifications\Notifiable;

class DealMessage extends Model
{
	//use Notifiable;

    protected $table = 'deal_messages';

    protected $dispatchesEvents = [
        'created' => BroadcastDealMessage::class
    ];

	protected $fillable = [
		'deal_id',
		'user_id',
		'friend_id',
		'deal_message'
    ];
}

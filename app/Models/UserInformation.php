<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserInformation extends Model
{
    /**
     * @var string
     */
    protected $table = 'user_informations';

    /**
     * @var string[]
     */
	protected $fillable = [
		'user_id',
		'information_id',
		'content'
    ];

    protected $visible = [
        'user_id',
        'information_id',
        'content'
    ];

    /**
     * @return BelongsTo
     */
   	public function user(): BelongsTo
   	{
   		return $this->belongsTo(User::class);
   	}

    /**
     * @return BelongsTo
     */
   	public function informationType(): BelongsTo
   	{
   		return $this->belongsTo(InformationType::class, 'information_id', 'id');
   	}
}

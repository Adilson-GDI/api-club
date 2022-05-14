<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTag extends Model
{
    /**
     * @var string
     */
    protected $table = 'user_tag';

    /**
     * @var string[]
     */
	protected $fillable = [
		'tag_id',
		'user_id'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
	protected $dates = [
		'created_at'
    ];

    /**
     * @return BelongsTo
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

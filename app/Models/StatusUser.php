<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatusUser extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'status_users';

    /**
     * @var string[]
     */
	protected $fillable = [
		'name'
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'name',
        'slug'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'status_user_id', 'id');
    }
}

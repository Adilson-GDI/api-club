<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActingRegion extends Model
{
    /**
     * @var string
     */
	protected $table = 'user_acting_regions';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
    	'user_id',
    	'acting_region_id'
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
    public function actingRegion(): BelongsTo
    {
        return $this->belongsTo(ActingRegion::class);
    }
}

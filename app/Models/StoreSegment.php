<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreSegment extends Model
{
    /**
     * @var string
     */
    protected $table = 'store_segments';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
	protected $fillable = [
		'user_id',
		'segment_id'
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
    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }
}

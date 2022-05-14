<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AwardRedeem extends Model
{
    /**
     * @var string
     */
    protected $table = 'award_redeems';

    /**
     * @var string[]
     */
    protected $fillable = [
        'award_id',
        'package_id',
        'user_id',
        'score_id',
        'discount',
        'addition',
        'description',
        'active',
        'accepted_at'
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'discount',
        'addition',
        'description',
        'active',
        'accepted_at'
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'accepted_at'
    ];

    /**
     * @return BelongsTo
     */
    public function award(): BelongsTo
    {
        return $this->belongsTo(Award::class, 'award_id');
    }

    /**
     * @return BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(AwardPackage::class, 'package_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class, 'score_id');
    }

    /**
     * @param $query
     * @return Builder
     */
    public function scopeActive($query): Builder
    {
        return $query->where('active', 1);
    }
}

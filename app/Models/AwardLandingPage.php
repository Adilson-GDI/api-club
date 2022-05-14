<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    HasOne
};

class AwardLandingPage extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'award_landing_pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'award_id',
        'award_template_id',
    ];

    /**
     * Relation with award
     *
     * @return HasOne
     */
    public function award(): HasOne
    {
        return $this->hasOne(Award::class, 'award_id');
    }

    /**
     * @return HasOne
     */
    public function awardTemplate(): HasOne
    {
        return $this->hasOne(AwardTemplate::class, 'award_template_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    hasOne
};

class AwardLandingPageContent extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'award_landing_page_contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'page_id',
        'award_template_position_id',
        'active'
    ];

    /**
     * @return HasOne
     */
    public function page(): HasOne
    {
        return $this->hasOne(AwardLandingPage::class);
    }

    /**
     * @return HasOne
     */
    public function templatePosition(): HasOne
    {
        return $this->hasOne(AwardTemplatePosition::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query): mixed
    {
        return $query->where('active', 1);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo
};

class AwardLandingPageFile extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'award_landing_page_files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_name',
        'file_type',
        'page_id',
        'award_template_position_id',
        'active'
    ];

    /**
     * @return BelongsTo
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(AwardLandingPage::class);
    }

    /**
     * @return BelongsTo
     */
    public function templatePosition(): BelongsTo
    {
        return $this->belongsTo(AwardTemplatePosition::class);
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

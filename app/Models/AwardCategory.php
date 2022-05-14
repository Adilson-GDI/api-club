<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    hasMany
};

class AwardCategory extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'award_categories';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'active'
    ];

    /**
     * @return BelongsTo
     */
    public function award(): BelongsTo
    {
        return $this->belongsTo(Award::class, 'id', 'category_id');
    }

    /**
     * @return hasMany
     */
    public function awards(): hasMany
    {
        return $this->hasMany(Award::class, 'category_id', 'id');
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    HasMany
};

class AwardPackage extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'award_packages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'slug',
        'required_scores',
        'available_qnt',
        'is_main',
        'show_available',
        'redeem_begin',
        'redeem_end',
        'award_id',
        'active'
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'title',
        'description',
        'slug',
        'required_scores',
        'available_qnt',
        'is_main',
        'show_available',
        'redeem_begin',
        'redeem_end',
        'active',
        'created_at'
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'redeem_begin',
        'redeem_end',
        'created_at',
        'updated_at'
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeMain($query)
    {
        return $query->where('is_main', 1);
    }

    /**
     * Relation with award
     *
     * @return HasMany
     */
    public function award(): HasMany
    {
        return $this->hasMany(Award::class, 'award_id');
    }

    /**
     * @return HasMany
     */
    public function redeems()
    {
        return $this->hasMany(AwardRedeem::class, 'package_id', 'id');
    }

    /**
     * @return bool
     */
    public function isMain(): bool
    {
        return ($this->is_main === 1);
    }

}

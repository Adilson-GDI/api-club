<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AwardTemplate extends Model
{
    /**
     * @var string
     */
    protected $table = 'award_templates';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'active'
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'name',
        'slug',
        'active'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param $query
     * @return Builder
     */
    public function scopeActive($query): Builder
    {
        return $query->where('active', 1);
    }
}

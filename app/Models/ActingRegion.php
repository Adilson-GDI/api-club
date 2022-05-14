<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ActingRegion extends Model
{
    /**
     * @var string
     */
    protected $table = 'acting_regions';

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
        'id',
        'name',
        'slug'
    ];

    /**
     * @return HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            UserActingRegion::class,
            'acting_region_id',
            'id',
            'id',
            'user_id'
        );
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query): mixed
    {
        return $query->where('active', 'yes');
    }
}

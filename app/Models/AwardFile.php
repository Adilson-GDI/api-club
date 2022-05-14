<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo
};

class AwardFile extends Model
{
    /**
     * @var string
     */
    protected $table = 'award_files';

    /**
     * @var string[]
     */
    protected $guard = ['id'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'title',
        'award_id',
        'size',
        'type',
        'active'
    ];

    protected $visible = [
        'id',
        'name',
        'title',
        'size',
        'type',
        'active',
        'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'active'
    ];

    /**
     * Aponta a qual premiação o item pertence
     *
     * @return BelongsTo
     */
    public function award(): BelongsTo
    {
        return $this->belongsTo(Award::class, 'award_id');
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

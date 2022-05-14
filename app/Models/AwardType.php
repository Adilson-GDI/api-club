<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AwardType extends Model
{
    /**
     * @var string
     */
    protected $table = 'awards_types';

    /**
     * @var string[]
     */
    protected $guard = ['id'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'name',
        'slug',
    ];

    /**
     * @return BelongsTo
     */
    public function award(): BelongsTo
    {
        return $this->belongsTo(Award::class, 'type_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    HasOne,
    hasManyThrough
};

class Tag extends Model
{
    /**
     * @var string
     */
    protected $table = 'tags';

    /**
     * @var string[]
     */
	protected $fillable = [
		'name',
		'slug',
        'category_id'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    public $dates = [
        'created_at'
    ];

    /**
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(TagCategory::class);
    }

    /**
     * @return HasManyThrough
     */
    public function users(): hasManyThrough
    {
        return $this->hasManyThrough(
            User::class, // destino
            UserTag::class, // intermediaria
            'tag_id', // intermediaria->origem
            'id', // destino->intermediaria
            'id', // origem->intermediaria
            'user_id' // intermediaria->destino
        );
    }
}

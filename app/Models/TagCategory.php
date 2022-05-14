<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TagCategory extends Model
{
    /**
     * @var string
     */
    protected $table = 'tag_categories';

    /**
     * @var string[]
     */
	protected $fillable = [
		'name',
		'slug',
        'description'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

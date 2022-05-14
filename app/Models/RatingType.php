<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingType extends Model
{
    public $timestamps = false;

    protected $table = 'rating_types';

	protected $fillable = [
		'name',
        'slug',
        'active'
    ];
}


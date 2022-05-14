<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'occupations';

    /**
     * @var string[]
     */
	protected $fillable = [
		'name',
		'slug'
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'name',
        'slug'
    ];
}

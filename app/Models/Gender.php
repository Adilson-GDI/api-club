<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    /**
     * @var string[]
     */
    protected $guard = ['id'];

    /**
     * @var string
     */
    protected $table = 'genders';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'shor_name',
        'slug'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
    	'active'
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'name',
        'shor_name',
        'slug'
    ];
}

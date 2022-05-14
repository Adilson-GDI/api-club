<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    /**
     * @var string[]
     */
    protected $guard = ['id'];

    /**
     * @var string
     */
    protected $table = 'marital_status';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
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
     * @var bool
     */
    public $timestamps = false;
}

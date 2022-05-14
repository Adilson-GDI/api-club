<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    public $timestamps = false;

    protected $table = 'specialities';

	protected $fillable = [
		'name'
    ];
}

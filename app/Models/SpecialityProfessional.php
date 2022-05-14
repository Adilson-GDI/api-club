<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialityProfessional extends Model
{
    public $timestamps = false;

    protected $table = 'speciality_professionals';

	protected $fillable = [
		'user_id',
		'speciality_id'
    ];
}

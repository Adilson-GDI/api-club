<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationType extends Model
{
    public $timestamps = false;

    protected $table = 'informations_types';

	protected $fillable = [
		'name'
    ];

    public function getBySlug($slug)
    {
    	return $this->where('slug', $slug)->first();
    }
}


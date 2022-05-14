<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusDeal extends Model
{
    public $timestamps = false;

    protected $table = 'status_deals';

	protected $fillable = [
		'name'
    ];
}

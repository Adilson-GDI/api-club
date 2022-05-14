<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusBilling extends Model
{
    public $timestamps = false;

    protected $table = 'status_billings';

	protected $fillable = [
		'name'
    ];
}

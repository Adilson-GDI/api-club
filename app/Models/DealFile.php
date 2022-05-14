<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealFile extends Model
{
    protected $table = 'deals_files';

	protected $fillable = [
		'user_id',
		'deal_id',
		'name'
    ];
}

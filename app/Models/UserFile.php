<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    protected $table = 'user_files';

	protected $fillable = [
		'user_id',
		'name',
		'information_type_id',
		'description',
		'size'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
		'deleted_at'
    ];

   	public function user()
   	{
   		return $this->belongsTo(\Clubecasa\Models\User::class);
   	}

   	public function informationType()
   	{
   		return $this->belongsTo(\Clubecasa\Models\InformationType::class, 'information_type_id', 'id');
   	}
}

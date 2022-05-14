<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Clubecasa\Contracts\UserInterface;

class Collaborator extends Model
{
    protected $table = 'collaborators';

	protected $fillable = [
		'user_id',
		'master_id',
		// 'name',
		'role'
		// 'phone',
		// 'cellphone',
		// 'cpf'
    ];

    public function user()
    {
        return $this->belongsTo(\Clubecasa\Models\User::class,'user_id','id');
    }

    public function byStore()
    {
        return $this->belongsTo(\Clubecasa\Models\User::class,'master_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAllowed extends Model
{
    protected $guard = ['id'];

    protected $table = 'users_allowed';

    protected $fillable = [
        'user_id',
        'allowed_perfil',
        'allowed_regulation'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id', 'user_id');
    }
}

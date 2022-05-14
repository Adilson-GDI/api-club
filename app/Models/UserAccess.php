<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    protected $guard = ['id'];

    protected $table = 'users_accesses';

    protected $fillable = [
        'user_id',
        'session_id',
        'navigator',
        'ip',
        'latitide',
        'longitude',
    ];

    protected $hidden = [];

    protected $dates = [
        'created_at',
        'logout_at'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(\Clubecasa\Models\User::class, 'id', 'user_id');
    }

    public function hasSession($session_id)
    {
    	return $this->hasOne(\Clubecasa\Models\Professional::class, 'user_id', 'id');
    }

    public function userAccessByPeriod($date_start, $date_end)
    {
        return $this->hasOne(\Clubecasa\Models\Professional::class, 'user_id', 'id');
    }
}

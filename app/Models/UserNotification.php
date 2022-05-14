<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'user_notifications';

    protected $guard = ['id'];

    protected $fillable = [
        'user_id',
        'template_id',
        'type_id',
        'from_user_id',
        'source_id',
        'content',
        'active'
    ];

    protected $dates = [
        'read_at'
    ];
}

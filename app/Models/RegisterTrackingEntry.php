<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class RegisterTrackingEntry extends Model
{
    protected $table = 'register_tracking_entries';

    protected $guard = ['id'];

    protected $fillable = [
        'register_tracking_id',
        'user_invited_id',
        'entry_status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = [
    	'created_at',
    	'updated_at'
    ];

    /**
     * Obtem o tipo e premiação, se campanha ou rescatáveis
     * @return \Clubecasa\Models\AwardType
     */
    public function registerTracking()
    {
        return $this->hasOne(\Clubecasa\Models\RegisterTracking::class, 'id', 'register_tracking_id');
    }

    public function professional()
    {
        return $this->hasOne(\Clubecasa\Models\User::class, 'id', 'user_invited_id');
    }

    public function status()
    {
        return $this->hasOne(\Clubecasa\Models\TrackingEntryStatus::class, 'id', 'entry_status_id');
    }
}

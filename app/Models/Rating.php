<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';

    protected $guard = ['id'];

    protected $fillable = [
        'rating',
        'description',
        'appraiser_user_id',
        'rated_user_id',
        'deal_id',
        'rating_type_id',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = [
    	'date_begin',
    	'date_end'
    ];

    /**
     * Obtem o tipo e premiação, se campanha ou rescatáveis
     * @return \Clubecasa\Models\AwardType
     */
    public function type()
    {
        return $this->hasOne(\Clubecasa\Models\AwardType::class, 'id', 'type_id');
    }

    public function deal()
    {
        return $this->hasOne(\Clubecasa\Models\Deal::class, 'id', 'deal_id');
    }

    public function appraiser()
    {
        return $this->hasOne(\Clubecasa\Models\User::class, 'id', 'appraiser_user_id');
    }

    public function rated()
    {
        return $this->hasOne(\Clubecasa\Models\User::class, 'id', 'rated_user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class RegisterTracking extends Model
{
    protected $table = 'register_trackings';

    protected $guard = ['id'];

    protected $fillable = [
        'promoter_type_id',
        'promoter_id',
        'campaign_id',
        'code'
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
    public function promoterType()
    {
        return $this->hasOne(\Clubecasa\Models\AwardType::class, 'id', 'type_id');
    }

    public function promoter()
    {
        return $this->hasOne(\Clubecasa\Models\AwardCategory::class, 'id', 'category_id');
    }

    public function campaign()
    {
        return $this->hasOne(\Clubecasa\Models\AwardCategory::class, 'id', 'category_id');
    }
}

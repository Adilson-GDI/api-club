<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    BelongsTo,
    hasOne,
    hasManyThrough
};

class Store extends Model
{
    /**
     * @var string
     */
    protected $table = 'stores';

    /**
     * @var string[]
     */
	protected $fillable = [
		'inauguration_date',
		'number_stores',
		'picture',
		'about',
        'points_multiplies',
        'store_name'
    ];

    /**
     * @var string[]
     */
    protected $dates = [
    	'inauguration_date'
	];

//    protected $allowedFilters = [
//        'stores.id',
//        'stores.user_id',
//        'picture',
//        'about',
//        'inauguration_date',
//        'user.name',
//        'segment.id',
//        'acting_regions.id',
//    ];

//    protected $orderable = [
//        'stores.id','id',
//        'user.name',
//        'user.id',
//        'acting_regions.id',
//        'segment.id',
//    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id','user_id');
    }

    /**
     * Aponta o endereço da loja
     *
     * @return hasOne
     */
//    public function address(): hasOne
//    {
//        return $this->hasOne(Address::class, 'user_id', 'user_id');
//    }

    /**
     * Busca regiões de atuação da loja
     *
     * @return hasManyThrough
     */
    public function actingRegions(): hasManyThrough
    {
        return $this->hasManyThrough(
        	ActingRegion::class,
        	UserActingRegion::class,
        	'user_id',
            'id',
        	'user_id',
        	'acting_region_id'
        )->where('active', 'yes');
    }

    /**
     * @return HasManyThrough
     */
    public function segments(): HasManyThrough
    {
        return $this->hasManyThrough(
            Segment::class, // Destino
            StoreSegment::class, // Intermediária
            'user_id', // intermediaria->origem
            'id', // destino->intermediaria
            'user_id', // origem->intermediaria
            'segment_id' // intermediaria->final
        );
    }

    /**
     * Busca seguimentos de atuação da loja
     * @return ActingRegion
     */
//    public function segment()
//    {
//        return $this->hasManyThrough(
//            Segment::class,
//            StoreSegment::class,
//        	'user_id',
//            'id',
//            'user_id',
//            'segment_id'
//        );
//    }

    /**
     * Busca seguimentos de atuação da loja
     * @return ActingRegion
     */
//    public function segments()
//    {
//        return $this->hasMany(Segment::class);
//    }

//    public function listSegment()
//    {
//        return $this->hasMany(Segment::class);
//    }

//    public function DealsToBilling()
//    {
//        return $this->hasMany(Deal::class,'user_store_id','user_id')->where('billing','no')->where('status_deal_id','=','4')->orderBy('approved_at','desc');
//    }
//
//    public function DealsFinish()
//    {
//        return $this->hasMany(Deal::class,'user_store_id','user_id')->where('billing','yes')->where('status_deal_id','=','5')->orderBy('created_at','desc');
//    }

    /**
     * Informa se a loja esta ativa ou não
     * @return boolean
     */
//    public function storeIsActive()
//    {
//    	return (boolean) $this->user()->where('status_user_id', 2)->get();
//    }

    /**
     * Aponta o tipo de usuário (professional/lojista)
     * @return TypeUser
     */
//    public function type()
//    {
//        return $this->hasOne(TypeUser::class,'id','type_user_id');
//    }
//
//    public function setNumberStoresAttribute($numberStores)
//    {
//        $this->attributes['number_stores'] = (is_numeric($numberStores)) ? $numberStores : 1;
//    }
//
//    public function setInaugurationDateAttribute($inaugurationDate)
//    {
//        $this->attributes['inauguration_date'] = date_pt_to_en($inaugurationDate);
//    }
//
//    public function totalScoresByPeriodNotExpired($dateStart, $dateFinish)
//    {
//
//        /** Valida as datas informadas */
//        if (!validate($dateStart) && !validate($dateFinish) )
//            return null;
//
//        $deals = $this->DealsFinish;
//        $total = 0;
//
//        foreach ($deals as $deal) {
//
//            if ( ($deal->completed_at > $dateStart) && ($deal->completed_at < $dateFinish)) {
//                $total += $deal->value / $deal->store_points_multiplies;
//            }
//        }
//
//        return intval($total);
//    }

    /**
     * Relaciona com informações do usuário
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
//    public function informations()
//    {
//        return $this->hasMany(UserInformation::class,'user_id','user_id');
//    }
//
//    public function storeInfoDocument()
//    {
//        return $this->hasMany(UserInformation::class, 'user_id','user_id')->with('InformationType')->whereHas('InformationType', function($q) {
//                $q->where('type','=','document');
//            });
//    }


//    public function collaborators()
//    {
//        return $this->hasManyThrough(
//            User::class,
//            Collaborator::class,
//            'id',
//            'user_id',
//            'id',
//            'master_id'
//        );
//    }


}

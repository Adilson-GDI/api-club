<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Clubecasa\Events\BroadcastDeal;
use Clubecasa\Support\DataviewerDeal;

class Deal extends Model
{
    use DataviewerDeal;
    use Notifiable;

    protected $table = 'deals';

    protected $allowedFilters = [
        'deals.name', 'status_deal_id', 'value',
        'deals.created_at', 'store_points_multiplies',

        'profissional.name',

        'lojista.name', 'loja.store_name',

        'status.name','status.id',
    ];

    protected $orderable = [
        'name', 'status_deal_id', 'value',
        'deals.created_at','status.name','profissional.name','lojista.name','loja.store_name',
    ];

    protected $dispatchesEvents = [
        'created' => BroadcastDeal::class,
        'saved' => BroadcastDeal::class
    ];

	protected $fillable = [
		'user_store_id',
		'user_professional_id',
		'status_deal_id',
		'name',
		'value',
        'store_points_multiplies',
        'created_at',
        'stopped_at',
        'approved_at',
        'completed_at'
    ];

    protected $dates = [
        'stopped_at',
        'approved_at',
        'completed_at',
        'updated_at'
    ];

    public function profissional()
    {
        return $this->hasOne('\Clubecasa\Models\User','id','user_professional_id');
    }

    public function lojista()
    {
        return $this->hasOne('\Clubecasa\Models\User','id','user_store_id')->with('store');
    }

    public function status()
    {
        return $this->hasOne('\Clubecasa\Models\StatusDeal','id','status_deal_id');
    }

    public function getNameStoreAttribute()
    {
    	return $this->store->name;
    }

    public function isBilling()
    {
        return ($this->billing == 'yes');
    }

    public function dealProfessional(){
        return $this->hasOne(User::class, 'id','user_professional_id');
    }

    public function dealStore(){
        return $this->hasOne(User::class, 'id','user_store_id')->with('store');
    }

    /**
     * Arquivos relacionados a uma negociação
     *
     * @return \Illuminate\Database\Eloquent\Relations
     */
    public function files()
    {
        return $this->hasMany(\Clubecasa\Models\DealFile::class, 'deal_id', 'id');
    }

    public function ownBill(){
        return $this->hasMany(\Clubecasa\Models\BillingDeal::class, 'deal_id', 'id')->with('billing');
    }

    public function storeActingRegionsShort()
    {
        return $this->hasManyThrough(
            //2 prmeiros parametros determinaram qual caminho de sera seguido para o relacionamento
            \Clubecasa\Models\ActingRegion::class, //tabela final
            \Clubecasa\Models\UserActingRegion::class, //tabela intermediaria

            //2 próximos parametros, são relacionados com os ultimos parametros
            'user_id', //campo da tabela intermediaria que sera relacionado tabela de origem
            'id', //campo da tabela final que sera relacionado com a tabela intermediaria

            //2 ultimos parametros são os campos que se relacionam com os de cima
            'user_store_id', //campo tabela origem para se relacionar com a tabela intermediaria
            'acting_region_id' //campo da tabela intermediaria vai se relacionar com a tabela final
        )->where('active','yes')->select('acting_regions.id','acting_regions.name');
    }
}

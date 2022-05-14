<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billings';

    protected $guard = ['id'];

    protected $fillable = [
        'user_store_id',
        'status_billing_id',
        'identification',
        'date_expiration',
        'increase',
        'decrease',
        'value',
        'billing_description',
        'projects',
        'active'
    ];

    protected $dates = [
        'date_expiration'
    ];

    //data_criacao , status, nome da loja

    public function store()
    {
        return $this->hasOne(\Clubecasa\Models\Store::class,'user_id','user_store_id');
    }

    public function user()
    {
        return $this->belongsTo(\Clubecasa\Models\User::class,'user_store_id','id');
    }


    public function status()
    {
        return $this->hasOne(\Clubecasa\Models\StatusBilling::class,'id','status_billing_id');
    }

    public function dealsToBilling()
    {
        return $this->hasMany(\Clubecasa\Models\BillingDeal::class,'id','billing_id');
    }

    public function dealsBilling() {
        return $this->hasManyThrough(
                //2 prmeiros parametros determinaram qual caminho de sera seguido para o relacionamento
                \Clubecasa\Models\Deal::class, //tabela final
                \Clubecasa\Models\BillingDeal::class, //tabela intermediaria

                //2 próximos parametros, são relacionados com os ultimos parametros
                'billing_id', //campo da tabela intermediaria que sera relacionado tabela de origem
                'id', //campo da tabela final que sera relacionado com a tabela intermediaria

                //2 ultimos parametros são os campos que se relacionam com os de cima
                'id', //campo tabela origem para se relacionar com a tabela intermediaria
                'deal_id' //campo da tabela intermediaria vai se relacionar com a tabela final
            )->with('profissional');
    }

}

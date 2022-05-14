<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingDeal extends Model
{
    protected $table = 'billing_deals';

	protected $fillable = [
		'deal_id',
		'billing_id'
    ];

    public function billing(){
        return $this->hasMany(\Clubecasa\Models\Billing::class, 'id', 'billing_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeTransaction extends Model
{
    public $timestamps = false;

    protected $table = 'type_transactions';

	protected $fillable = [
		'name'
    ];

    public function user()
    {
        return $this->belongsTo('\Clubecasa\Models\Score', 'type_transaction_id', 'id');
    }

    /**
     * Informa quando uma transação é um débito
     * @return boolean
     */
    public function isDebit()
    {
        return ($this->id == 1);
    }

    /**
     * Informa quando uma transação é um crédito
     * @return boolean
     */
    public function isCredit()
    {
        return ($this->id == 2);
    }
}

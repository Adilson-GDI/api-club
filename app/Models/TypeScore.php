<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeScore extends Model
{
    public $timestamps = false;

    protected $table = 'type_scores';

	protected $fillable = [
		'name'
    ];

    public function score()
    {
        return $this->belongsTo(\Clubecasa\Models\Score::class, 'type_score_id', 'id');
    }

    /**
     * É um projeto
     * @return boolean
     */
    public function isProject()
    {
    	return ($this->id == 1);
    }

    /**
     * É um evento
     * @return boolean
     */
    public function isEvent()
    {
    	return ($this->id == 2);
    }

    /**
     * É um engajamento
     * @return boolean
     */
    public function isEngage()
    {
    	return ($this->id == 3);
    }

    /**
     * É uma gameficação
     * @return boolean
     */
    public function isGaming()
    {
    	return ($this->id == 4);
    }

    /**
     * É um resgate de premio
     * @return boolean
     */
    public function isRescuePremium()
    {
    	return ($this->id == 5);
    }
}

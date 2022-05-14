<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [
        'name',
        'abbr',
        'slug',
        'active',
    ];

    protected $visible = [
        'id',
        'name',
        'abbr',
        'slug',
    ];

    /**
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    //buscar usuarios por estado
//    public function allUsers()
//    {
//        return $this->hasManyThrough(
//            //2 prmeiros parametros determinaram qual caminho de sera seguido para o relacionamento
//            'Clubecasa\Models\User', //tabela final
//            'Clubecasa\Models\Address', //tabela intermediaria
//
//            //2 próximos parametros, são relacionados com os ultimos parametros
//            'state_id', //campo da tabela intermediaria que sera relacionado tabela de origem
//            'id', //campo da tabela final que sera relacionado com a tabela intermediaria
//
//            //2 ultimos parametros são os campos que se relacionam com os de cima
//            'id', //campo tabela origem para se relacionar com a tabela intermediaria
//            'user_id' //campo da tabela intermediaria vai se relacionar com a tabela final
//        );
//    }

}

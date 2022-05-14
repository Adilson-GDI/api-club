<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\PersonalAccessTokenResult;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\{
    HasOne,
    HasMany,
    BelongsTo,
    hasManyThrough
};

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'name',
        'username',
        'email',
        'type_user_id',
        'status_user_id',
        'active',
        'picture',
        'code',
    ];

    /**
     * @return HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(StatusUser::class, 'id', 'status_user_id');
    }

    /**
     * @return HasOne
     */
    public function type(): HasOne
    {
        return $this->hasOne(TypeUser::class,'id','type_user_id');
    }

    /**
     * Relaciona tabela de stores quando o usuário for um lojista
     *
     * @return hasOne
     */
    public function store(): hasOne
    {
        return $this->hasOne(Store::class, 'user_id', 'id');
    }

    /**
     * Relaciona tabela professionals
     *
     * @return BelongsTo
     */
    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'id', 'user_id');
    }

    /**
     * @return hasOne
     */
    public function address(): hasOne
    {
        return $this->hasOne(Address::class, 'user_id', 'id');
    }

    /**
     * Cria token para acesso do usuário via Laravel Passport
     *
     * @return PersonalAccessTokenResult
     */
    public function createPersonalAccessToken(): PersonalAccessTokenResult
    {
        return $this->createToken('Club&Casa');
    }

    /**
     * Cria escopo de método para trazer apenas usuários que sejam lojistas
     *
     * @param $query
     * @return mixed
     */
    public function scopeStores($query): mixed
    {
        return $query->where('type_user_id', 2);
    }

    /**
     * Cria escopo de método para trazer apenas usuários ativos
     *
     * TODO: alterar retorno para tipo Builder
     * @param $query
     * @return mixed
     */
    public function scopeActive($query): mixed
    {
        return $query->where('status_user_id', 2);
    }

    /**
     * Verifica se o usuario logado é um profissional
     *
     * @return bool
     */
    public function isProfessional(): bool
    {
        return ($this->type_user_id === 3);
    }

    /**
     * Verifica se o usuario logado é um lojista
     *
     * @return bool
     */
    public function isStore(): bool
    {
        return ($this->type_user_id === 2);
    }

    /**
     * @return HasMany
     */
    public function informations(): HasMany
    {
        return $this->hasMany(UserInformation::class);
    }

    /**
     * @param String $slug
     * @return mixed
     */
    public function information($slug): mixed
    {
        $value = null;

        foreach ($this->informations as $information) {
            if ($slug === $information->informationType->slug) {
                $value = $information->content;
                break;
            }
        }

        return $value;
    }

    /**
     * @return hasManyThrough
     */
    public function actingRegions(): hasManyThrough
    {
        return $this->hasManyThrough(
            ActingRegion::class, // Destino
            UserActingRegion::class, // Intermediaria
            'user_id', // intermediaria->origem
            'id', // destino->intermediaria
            'id', // origem->intermediaria
            'acting_region_id' // intermediaria->destino
        );
    }

    /**
     * @return hasManyThrough
     */
    public function segments(): hasManyThrough
    {
        return $this->hasManyThrough(
            Segment::class, // Destino
            StoreSegment::class, // Intermediaria
            'user_id', // intermediaria->origem
            'id', // destino->intermediaria
            'id', // origem->intermediaria
            'segment_id' // intermediaria->destino
        );
    }

    /**
     * Pontuações
     *
     * @return hasMany
     */
    public function scores(): hasMany
    {
        return $this->hasMany(Score::class, 'user_id', 'id');
    }

    /**
     * @return HasManyThrough
     */
    public function tags(): HasManyThrough
    {
        return $this->hasManyThrough(
            Tag::class, // Destino
            UserTag::class, // Intemediaria
            'user_id', // intermediaria->origem
            'id', // destino->intermediaria
            'id', // origem->intermediaria
            'tag_id' // intermediaria->destino
        );
    }



























































    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User
     */
//    public function findForPassport($username)
//    {
//        return $this->where('username', $username)->first();
//    }



    //protected $appends = ['total'];



    /**
     * Verifica se o usuario logado é do financeiro
     * @return boolean
     */
//    public function isFinancial()
//    {
//        return (boolean) ($this->type_user_id == 4);
//    }

    /**
     * Verifica se o usuario logado é da gerencia
     * @return boolean
     */
//    public function isManager()
//    {
//        return (boolean) ($this->type_user_id == 5);
//    }

    /**
     * Verifica se o usuario logado é do marketing
     * @return boolean
     */
//    public function isMarketing()
//    {
//        return (boolean) ($this->type_user_id == 6);
//    }

    /**
     * Verifica se o usuario logado é um colaborador
     * @return boolean
     */
//    public function isCollaborator()
//    {
//        return (boolean) ($this->type_user_id == 7);
//    }

    /**
     * Verifica se o usuario logado é um admin
     * @return boolean
     */
//    public function isAdmin()
//    {
//        return (boolean) ($this->type_user_id == 1);
//    }

    /**
     * Verifica se o usuario esta com status ativo
     * @return boolean
     */
//    public function isActive()
//    {
//        return (boolean) ($this->status_user_id == 2);
//    }

    /**
     * Relaciona usuários a qual me relacionei na plataforma
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
//    public function friendsOfMine()
//    {
//        return $this->belongsToMany(\App\Models\User::class, 'friends', 'user_id', 'friend_id');
//    }

    /**
     * Relaciona usuário a qual tenha relação em alguma negociação
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
//    public function friendOf()
//    {
//        return $this->belongsToMany(\App\Models\User::class, 'friends', 'friend_id', 'user_id');
//    }

    /**
     * Relaciona usuário a qual tive alguma relação de negociação na plataforma
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
//    public function friends() {
//        return $this->friendsOfMine->merge($this->friendOf);
//    }

    /**
     * Retorna os tipos de relacionamento com usuários de acordo com informado no parâmetro
     * @param  Integer
     * @return \App\Models\User
     */
//    public function friendsType($type)
//    {
//        return User::where('type_user_id', $type)->get();
//    }

    /**
     * Envia e-mail para recuperação de senha do usuário
     * @param  string $token Token passado para e-mail e gerado em banco para autenticação
     * @return void
     */
//    public function sendPasswordResetNotification($token)
//    {
//        try {
//            \Mail::send('emails.reset-password', ['token' => $token], function($message) {
//                $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
//                $message->to($this->email);
//                $message->subject('Redefinição de senha - Club & Casa');
//                //$message->bcc('ti@clubecasadesign.com.br', 'Suporte');
//            });
//
//        } catch (Exception $e) {
//            throw new \Exception("Não foi possivel enviar o e-mail pois o mesmo não foi informado", 1);
//        }
//    }

    /**
     * Envia e-mail para colaborador adicionado pelo lojista
     * @param  string $token Token passado para e-mail e gerado em banco para autenticação
     * @return void
     */
//    public function sendLoginCollaborator($email, $password, $store)
//    {
//        //dd($store);
//        try {
//            \Mail::send('emails.collaborator-login', ['email' => $email,'password' => $password,'store' => $store], function($message) {
//                $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
//                $message->to($this->email);
//                $message->subject('Novo colaborador - Club & Casa');
//                //$message->bcc('ti@clubecasadesign.com.br', 'Suporte');
//            });
//
//        } catch (Exception $e) {
//            throw new \Exception("Não foi possivel enviar o e-mail pois o mesmo não foi informado", 1);
//        }
//    }

    /**
     * Relaciona com a tabela especifica referente ao tipo de usuário
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
//    public function profile()
//    {
//        if ($this->isProfessional()) {
//            return $this->hasOne(\App\Models\Professional::class, 'user_id', 'id');
//        }
//
//        if ($this->isStore()) {
//            return $this->hasOne(\App\Models\Store::class, 'user_id', 'id');
//        }
//
//        if ($this->isCollaborator()) {
//            return $this->hasOne(\App\Models\Collaborator::class, 'user_id', 'id');
//        }
//    }







    /**
     * Relaciona apenas usuário que realizaram resgates
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
//    public function hasRescue()
//    {
//        return $this->hasMany(\App\Models\Score::class, 'user_id', 'id')->where([['active','yes'],['type_scores_id',5]]);
//    }

//    public function debitRescue($value){
//
//        while ($value > 0) {
//            $scoreDebit = Score::where([
//                ['user_id',$this->id],
//                ['expiration', '>', now()],
//                ['value_true', '>', 0],
//                ['active','yes'],
//                ['type_transactions_id',2]])
//            ->first();
//            if($scoreDebit){
//                if($value > $scoreDebit->value_true){
//                    $value = $value - $scoreDebit->value_true;
//                    $scoreDebit->value_true = 0;
//                    $scoreDebit->save();
//                }else{
//                    $scoreDebit->value_true = $scoreDebit->value_true - $value;
//                    $scoreDebit->save();
//                    $value = 0;
//                }
//            }else{
//                return $value;
//            }
//        }
//
//        return $value;
//    }

//    public function indebted($value){
//
//        while ($value > 0) {
//            $rescueDebit = Score::where([
//                ['user_id',$this->id],
//                ['value_true', '>', 0],
//                ['active','yes'],
//                ['type_transactions_id',1]])
//            ->first();
//            if($rescueDebit){
//                if($value > $rescueDebit->value_true){
//                    $value = $value - $rescueDebit->value_true;
//                    $rescueDebit->value_true = 0;
//                    $rescueDebit->save();
//                }else{
//                    $rescueDebit->value_true = $rescueDebit->value_true - $value;
//                    $rescueDebit->save();
//                    $value = 0;
//                }
//            }else{
//                return $value;
//            }
//        }
//
//        return $value;
//    }

    /**
     * Informa a quantidade de pontos VÁLIDOS do usuário
     * @return Integer
     */
//    public function totalScores()
//    {
//        $total = 0;
//
//        foreach ($this->scores as $score) {
//
//            if ($score->isCredit()) {
//                if ( ! $score->isExpired() ) {
//                    $total += $score->value_true;
//                }
//            } else {
//                $total -= $score->value_true;
//            }
//        }
//
//        return intval($total);
//    }

    /**
     * Fornece o total de pontos do usuário no período especificado
     *
     * @param  String $dateStart        Recebido no formato yyyy-mm-dd
     * @param  String $dateFinish       Recebido no formato yyyy-mm-dd
     * @return Integer
     */
//    public function totalScoresByPeriodNotExpired($dateStart, $dateFinish)
//    {
//        if ( !$this->isProfessional() )
//            return null;
//
//        /** Valida as datas informadas */
//        if (!validate($dateStart) && !validate($dateFinish) )
//            return null;
//
//        $scores = $this->scores;
//        $total = 0;
//
//        foreach ($this->scores as $score) {
//
//            if ( $score->isCredit()
//                 && ($score->created_at > $dateStart)
//                 && ($score->created_at < $dateFinish)
//                 && ($score->type_scores_id == 1)
//                 ) {
//
//                $total += $score->value;
//            }
//        }
//
//        return intval($total);
//    }

    /**
     * Filtra todo tipo e atributo que tenta ser lido pela classe, criando novos em casa de informações do usuário
     * @param  String $key      atributo solicitado
     * @return Mixed
     */
//    public function __get($key)
//    {
//        if (in_array($key, \App\Lists\UserInformations::$getSlugs)) {
//            return $this->getInformation($key);
//        }
//
//        return $this->getAttribute($key);
//    }

    /**
     * Obtem um dado que seja do tipo informação do utuário (inforations table)
     * @param  String $key      Valor solicitado
     * @return Mixed
     */
//    public function getInformation($key)
//    {
//        foreach (\App\Lists\UserInformations::$getKeyAndSlug as $_key => $_value) {
//
//            foreach ($this->informations as $information) {
//
//                $idInformation = \App\Lists\UserInformations::$getSlugAndKey[$key];
//
//                if ($information->information_type_id == $idInformation) {
//                    return $information->content;
//                }
//            }
//        }
//
//        return null;
//    }

    /**
     * Aponto o usuário principal da conta, no caso do usuário ser um colaboraddor
     * @return \App\Models\User
     */
//    public function mainProfessional()
//    {
//        if ( $this->isProfessional() || $this->isStore() )
//            return $this;
//
//        if ( $this->isCollaborator() && $this->hasMainProfessional() )
//            return $this->mainProfessional;
//
//        if ( $this->isMarketing() || $this->isManager() )
//            return $this;
//
//        return null;
//    }

    /**
     * Verifica se o usuário é o principal ou se possui um usuário principal
     * @return boolean [description]
     */
//    public function hasMainProfessional()
//    {
//        return true;
//
//        /** Futura implementação */
//        // if ( $this->isCollaborator() ) {
//
//        //     if ($contributor = \App\Models\Contributor::where('contributor_id', $this->id)->first()) {
//
//        //         return (boolean) $this->mainProfessional = $contributor->professional;
//        //     }
//        // }
//
//        // return false;
//    }



//    public function prof()
//    {
//        return $this->hasOne(\App\Models\Professional::class, 'user_id', 'id')->with(['Occupation','MaritalStatus','Gender']);
//    }
//
//    public function profOccupation()
//    {
//        return $this->hasManyThrough(
//            //2 prmeiros parametros determinaram qual caminho de sera seguido para o relacionamento
//            \App\Models\Occupation::class, //tabela final
//            \App\Models\Professional::class, //tabela intermediaria
//
//            //2 próximos parametros, são relacionados com os ultimos parametros
//            'user_id', //campo da tabela intermediaria que sera relacionado tabela de origem
//            'id', //campo da tabela final que sera relacionado com a tabela intermediaria
//
//            //2 ultimos parametros são os campos que se relacionam com os de cima
//            'id', //campo tabela origem para se relacionar com a tabela intermediaria
//            'occupation_id' //campo da tabela intermediaria vai se relacionar com a tabela final
//        );
//    }
//
//    public function profOccupationShort()
//    {
//        return $this->hasManyThrough(
//            //2 prmeiros parametros determinaram qual caminho de sera seguido para o relacionamento
//            \App\Models\Occupation::class, //tabela final
//            \App\Models\Professional::class, //tabela intermediaria
//
//            //2 próximos parametros, são relacionados com os ultimos parametros
//            'user_id', //campo da tabela intermediaria que sera relacionado tabela de origem
//            'id', //campo da tabela final que sera relacionado com a tabela intermediaria
//
//            //2 ultimos parametros são os campos que se relacionam com os de cima
//            'id', //campo tabela origem para se relacionar com a tabela intermediaria
//            'occupation_id' //campo da tabela intermediaria vai se relacionar com a tabela final
//        )->select('occupations.id','occupations.name');
//    }
//
//    public function profSpeciality()
//    {
//        return $this->hasManyThrough(
//            //2 prmeiros parametros determinaram qual caminho de sera seguido para o relacionamento
//            Speciality::class, //tabela final
//            SpecialityProfessional::class, //tabela intermediaria
//
//            //2 próximos parametros, são relacionados com os ultimos parametros
//            'user_id', //campo da tabela intermediaria que sera relacionado tabela de origem
//            'id', //campo da tabela final que sera relacionado com a tabela intermediaria
//
//            //2 ultimos parametros são os campos que se relacionam com os de cima
//            'id', //campo tabela origem para se relacionar com a tabela intermediaria
//            'speciality_id' //campo da tabela intermediaria vai se relacionar com a tabela final
//        );
//    }
//
//    public function profSpecialityShort()
//    {
//        return $this->hasManyThrough(
//            //2 prmeiros parametros determinaram qual caminho de sera seguido para o relacionamento
//            Speciality::class, //tabela final
//            SpecialityProfessional::class, //tabela intermediaria
//
//            //2 próximos parametros, são relacionados com os ultimos parametros
//            'user_id', //campo da tabela intermediaria que sera relacionado tabela de origem
//            'id', //campo da tabela final que sera relacionado com a tabela intermediaria
//
//            //2 ultimos parametros são os campos que se relacionam com os de cima
//            'id', //campo tabela origem para se relacionar com a tabela intermediaria
//            'speciality_id' //campo da tabela intermediaria vai se relacionar com a tabela final
//        )->select('specialities.id','specialities.name');
//    }

//    public function profInfoContact()
//    {
//        return $this->hasMany(UserInformation::class)->with('InformationType')->whereHas('InformationType', function($q) {
//                $q->where('type','=','contact');
//            });
//    }
//
//    public function profInfoLink()
//    {
//        return $this->hasMany(UserInformation::class)->with('InformationType')->whereHas('InformationType', function($q) {
//                $q->where('type','=','link');
//            });
//    }
//
//    public function profInfoDocument()
//    {
//        return $this->hasMany(UserInformation::class)->with('InformationType')->whereHas('InformationType', function($q) {
//                $q->where('type','=','document');
//            });
//    }
//
//    public function profInfoData()
//    {
//        return $this->hasMany(UserInformation::class)->with('InformationType')->whereHas('InformationType', function($q) {
//                $q->where('type','=','data');
//            });
//    }
//
//    public function profInfo()
//    {
//        return $this->hasMany(UserInformation::class)->with('InformationType');
//    }
//

//    }
//
//    public function profActingRegionsShort()
//    {
//        return $this->hasManyThrough(
//            //2 prmeiros parametros determinaram qual caminho de sera seguido para o relacionamento
//            ActingRegion::class, //tabela final
//            UserActingRegion::class, //tabela intermediaria
//
//            //2 próximos parametros, são relacionados com os ultimos parametros
//            'user_id', //campo da tabela intermediaria que sera relacionado tabela de origem
//            'id', //campo da tabela final que sera relacionado com a tabela intermediaria
//
//            //2 ultimos parametros são os campos que se relacionam com os de cima
//            'id', //campo tabela origem para se relacionar com a tabela intermediaria
//            'acting_region_id' //campo da tabela intermediaria vai se relacionar com a tabela final
//        )->where('active','yes')->select('acting_regions.id','acting_regions.name');
//    }
//
//    public function profUserActingRegion()
//    {
//        return $this->hasMany(UserActingRegion::class, 'user_id', 'id');
//        //->with($this->hasOne(User::class, 'user_professional_id', 'id'));
//    }
//
//    public function linkPowerBi()
//    {
//        return $this->hasManyThrough(
//            //2 prmeiros parametros determinaram qual caminho de sera seguido para o relacionamento
//            PowerBiAccess::class, //tabela final
//            UserActingRegion::class, //tabela intermediaria
//
//            //2 próximos parametros, são relacionados com os ultimos parametros
//            'user_id', //campo da tabela intermediaria que sera relacionado tabela de origem
//            'id', //campo da tabela final que sera relacionado com a tabela intermediaria
//
//            //2 ultimos parametros são os campos que se relacionam com os de cima
//            'id', //campo tabela origem para se relacionar com a tabela intermediaria
//            'acting_region_id' //campo da tabela intermediaria vai se relacionar com a tabela final
//        );
//    }
//
//    public function profAddress()
//    {
//        return $this->hasOne(Address::class, 'user_id', 'id')->with('city')->with('state');
//    }
//
//    public function profDeals()
//    {
//        return $this->hasMany(Deal::class, 'user_professional_id', 'id')->with('dealStore:name,id,picture')->orderBy('deals.created_at','desc');
//        //->with($this->hasOne(User::class, 'user_professional_id', 'id'));
//    }
//
//    public function profOldDeals()
//    {
//        return $this->hasMany(OldDeal::class, 'user_professional_id', 'id')->with('dealStore:name,id,picture')->orderBy('old_deals.created_at','desc');
//        //->with($this->hasOne(User::class, 'user_professional_id', 'id'));
//    }
//
//    public function profDealsTrading()
//    {
//        return $this->hasMany(Deal::class, 'user_professional_id', 'id')->where('status_deal_id','=','1')->select( \DB::raw('sum( value ) as total, count(*) as amount, user_professional_id') )->groupBy('user_professional_id');
//    }
//
//    public function profDealsPending()
//    {
//        return $this->hasMany(Deal::class, 'user_professional_id', 'id')->where('status_deal_id','=','4')->select( \DB::raw('sum( value ) as total, count(*) as amount, user_professional_id') )->groupBy('user_professional_id');
//    }
//
//    public function profDealsFinished()
//    {
//        return $this->hasMany(Deal::class, 'user_professional_id', 'id')->where('status_deal_id','=','5')->select( \DB::raw('sum( value ) as total, count(*) as amount, user_professional_id') )->groupBy('user_professional_id');
//    }
//
//
//    public function storeActingRegions()
//    {
//        return $this->hasManyThrough(
//            //2 prmeiros parametros determinaram qual caminho de sera seguido para o relacionamento
//            ActingRegion::class, //tabela final
//            UserActingRegion::class, //tabela intermediaria
//
//            //2 próximos parametros, são relacionados com os ultimos parametros
//            'user_id', //campo da tabela intermediaria que sera relacionado tabela de origem
//            'id', //campo da tabela final que sera relacionado com a tabela intermediaria
//
//            //2 ultimos parametros são os campos que se relacionam com os de cima
//            'id', //campo tabela origem para se relacionar com a tabela intermediaria
//            'acting_region_id' //campo da tabela intermediaria vai se relacionar com a tabela final
//        )->where('active', 'yes');
//    }
//
//    public function storeUserActingRegion()
//    {
//        return $this->hasMany(UserActingRegion::class, 'user_id', 'id');
//        //->with($this->hasOne(User::class, 'user_professional_id', 'id'));
//    }
//
//    public function storeUserSegment()
//    {
//        return $this->hasMany(StoreSegment::class, 'user_id', 'id');
//        //->with($this->hasOne(User::class, 'user_professional_id', 'id'));
//    }
//
//    // public function informations()
//    // {
//    //     return $this->hasMany(UserInformation::class);
//    // }
//    //
//
//    public function storeAddress()
//    {
//        return $this->hasOne(Address::class, 'user_id', 'id')->with('city')->with('state');
//    }
//
//    public function storeInfoContact()
//    {
//        return $this->hasMany(UserInformation::class)->with('InformationType')->whereHas('InformationType', function($q) {
//                $q->where('type','=','contact');
//            });
//    }
//
//    public function storeInfo()
//    {
//        return $this->hasMany(UserInformation::class)->with('InformationType');
//    }
//
//    public function storeDeals()
//    {
//        return $this->hasMany(Deal::class, 'user_store_id', 'id')->with('dealProfessional:name,id,picture')->orderBy('deals.created_at','desc');
//        //->with($this->hasOne(User::class, 'user_professional_id', 'id'));
//    }
//
//    public function storeOldDeals()
//    {
//        return $this->hasMany(OldDeal::class, 'user_store_id', 'id')->with('dealProfessional:name,id,picture')->orderBy('old_deals.created_at','desc');
//        //->with($this->hasOne(User::class, 'user_professional_id', 'id'));
//    }
//
//    public function storeDealsTrading()
//    {
//        return $this->hasMany(Deal::class, 'user_store_id', 'id')->where('status_deal_id','=','1')->select( \DB::raw('sum( value ) as total, count(*) as amount, user_store_id') )->groupBy('user_store_id');
//    }
//
//    public function storeDealsPending()
//    {
//        return $this->hasMany(Deal::class, 'user_store_id', 'id')->where('status_deal_id','=','4')->select( \DB::raw('sum( value ) as total, count(*) as amount, user_store_id') )->groupBy('user_store_id');
//    }
//
//    public function storeDealsFinished()
//    {
//        return $this->hasMany(Deal::class, 'user_store_id', 'id')->where('status_deal_id','=','5')->select( \DB::raw('sum( value ) as total, count(*) as amount, user_store_id') )->groupBy('user_store_id');
//    }
//
//    public function hasAllowedTerms()
//    {
//        // TODO: é um relacionamento? Ou a criação de um dado, se sim, porque 'HAS'
//        return $this->hasOne(UserAllowed::class, 'user_id', 'id')->firstOrCreate(
//            ['user_id' =>  $this->id],['allowed_perfil' => 'no'],['allowed_regulation' => 'no']
//        );
//    }

//    public function hasNeededInfo()
//    {
//        //$this->picture &&
//        if ($this->type_user_id == 2) {
//            return (!empty($this->information('cnpj')) && !empty($this->information('phone')) && !empty($this->store->store_name));
//        } else {
//            return (!empty($this->information('cpf')) && !empty($this->information('phone')) && !empty($this->information('office')));
//        }
//    }

//    public function profilelandingPage()
//    {
//        return $this->hasOne(ProfileLandingPage::class)->where('profile_template_id',1);
//    }

//    public function hasAddress()
//    {
//        return (boolean) ($this->address);
//    }





//    public function ratings()
//    {
//        return $this->hasMany(Rating::class, 'rated_user_id', 'id');
//    }

//    public function rating()
//    {
//        $total = 0;
//        foreach ($this->ratings as $rating) {
//            $total+=$rating->rating;
//        }
//        return count($this->ratings) > 0 ? $total/count($this->ratings) : 0;
//    }

//    public function awardRedeems()
//    {
//        return $this->hasMany(AwardRedeem::class, 'user_id', 'id');
//    }
//
//    public function files()
//    {
//        return $this->hasMany(UserFile::class, 'user_id', 'id');
//    }
//
//    public function registerTracking()
//    {
//        return $this->hasMany(RegisterTracking::class, 'promoter_id', 'id');
//    }
}

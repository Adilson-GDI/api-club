<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    HasOne
};
//use Clubecasa\Support\DataviewerScore;

class Score extends Model
{
//	use DataviewerScore;

    /**
     * @var string
     */
    protected $table = 'scores';

    /**
     * @var string[]
     */
    protected $fillable = [
		'user_id',
		'type_transactions_id',
		'type_scores_id',
		'source_score_id',
		'value',
        'value_true',
		'expiration',
		'created_at'
    ];

    /**
     * @var string[]
     */
    protected $allowedFilters = [
        'scores.id',
        'scores.user_id',
        'type_transactions_id',
        'type_scores_id',
        'source_score_id',
        'value',
        'value_true',
        'expiration',
        'scores.created_at',
    ];

    /**
     * @var string[]
     */
//    protected $orderable = [
//        'id',
//        'type_transactions_id',
//        'value',
//        'scores.created_at',
//        'source_score_id',
//        'type_scores_id',
//    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'expiration'
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return hasOne
     */
    public function typeTransaction(): hasOne
    {
        return $this->hasOne(TypeTransaction::class, 'id', 'type_transactions_id');
    }

    /**
     * @return HasOne
     */
    public function typeScore(): hasOne
    {
        return $this->hasOne(TypeScore::class, 'id', 'type_scores_id');
    }

    /**
     * Débito
     *
     * @return boolean
     */
    public function isDebit(): boolean
    {
        return ($this->type_transactions_id === 1);
    }

    /**
     * Crédito
     *
     * @return boolean
     */
    public function isCredit(): boolean
    {
        return ($this->type_transactions_id === 2);
    }

    /**
     * Verifica se o ponto esta dentro do período de válidade
     *
     * @return boolean
     */
    public function isExpired()
    {
        return ( $this->expiration <= now() );
    }







//    public function store()
//    {
//        if($this->typeScore->id == 1)
//        {
//            return (\Clubecasa\Models\Deal::find($this->source_score_id))->lojista;
//            //dd($a);
//        }
//        return null;
//    }







    /**
     * Verifica se o ponto foi realmente faturado
     *
     * @return boolean
     */
//    public function isValidByBilling()
//    {
//        if ($this->isProject()) {
//
//            $deal = \Clubecasa\Models\Deal::find($this->source_score_id);
//
//            return $deal->isBilling();
//        }
//    }




//    public function scopeScoreAllFilter($query)
//    {
//        $user = \Auth::user();
//
//        $filterquery = $user->isStore()
//            ? "user_store_id"
//            : "user_professional_id";
//
//        $dataGeral = [];
//
//        $dataGeral['data'] = $this->process($query, request()->all())->where([ ['user_id','=',$user->id],['active','=','yes']])
//            ->orderBy(
//                request('order_column', 'scores.created_at'),
//                request('order_direction', 'desc')
//            )->with('typeScore','typeTransaction')
//            ->paginate(request('limit', 10));
//
//        foreach ($dataGeral['data'] as $key => $value) {
//            $dataGeral['data'][$key]->store = $value->store();
//        }
//
//        return $dataGeral;
//    }

//    public function scopeProjectFilter($query)
//    {
//        $user = \Auth::user();
//
//        $filterquery = '';
//
//        if($user->isStore()) {
//            $filterquery = "user_store_id";
//        }
//
//        if(\Auth::user()->isProfessional()) {
//            $filterquery = "user_professional_id";
//        }
//
//        $query = $query->join('users as profissional','profissional.id','=','user_professional_id');
//        $query = $query->join('users as lojista','lojista.id','=','user_store_id');
//        $query = $query->join('status_deals as status','status.id','=','status_deal_id');
//
//        $dataGeral = [];
//
//        $dataGeral['data'] = $this->process($query, request()->all())->where($filterquery,'=',$user->id)->where('status_deal_id','>=','4')->select('deals.*','profissional.name as profissional_name','lojista.name as lojista_name','status.name as status_name')->orderBy(request('order_column', 'deals.created_at'),request('order_direction', 'desc'))->with('profissional','status','lojista')->paginate(request('limit', 10));
//
//        $dataGeral['total'] = $this->process($query, request()->all())->where($filterquery,'=',$user->id)->where('status_deal_id','>=','4')->orderBy(request('order_column', 'deals.created_at'),request('order_direction', 'desc'))->with('profissional','status','lojista')->get();
//
//        $dataGeral['gerada'] = $dataGeral['data']->where('status_deal_id','=','5')->sum('value');
//
//        $dataGeral['pendente'] = $dataGeral['data']->where('status_deal_id','=','4')->sum('value');
//
//        return $dataGeral;
//    }
//
//    public function process($query, $data)
//    {
//        $v = validator()->make($data, [
//            'order_column' => 'sometimes|required|in:'.$this->orderableColumns(),
//            'order_direction' => 'sometimes|required|in:asc,desc',
//            'limit' => 'sometimes|required|integer|min:1',
//            // advanced filter
//            'filter_match' => 'sometimes|required|in:and,or',
//            'f' => 'sometimes|required|array',
//            'f.*.column' => 'required|in:'.$this->whiteListColumns(),
//            'f.*.operator' => 'required_with:f.*.column|in:'.$this->allowedOperators(),
//            'f.*.query_1' => 'required',
//            'f.*.query_2' => 'required_if:f.*.operator,between,not_between'
//        ]);
//
//        if($v->fails()) {
//            // debug
//            return dd($v->messages()->all());
//
//            throw new ValidationException;
//        }
//        return (new DealQueryBuilder)->apply($query, $data);
//    }
//
//    protected function whiteListColumns()
//    {
//        return implode(',', $this->allowedFilters);
//    }
//
//    protected function orderableColumns()
//    {
//        return implode(',', $this->orderable);
//    }
//
//    protected function allowedOperators()
//    {
//        return implode(',', [
//            'equal_to',
//            'not_equal_to',
//            'less_than',
//            'greater_than',
//            'between',
//            'not_between',
//            'contains',
//            'starts_with',
//            'ends_with',
//            'in_the_past',
//            'in_the_next',
//            'in_the_peroid',
//            'less_than_count',
//            'greater_than_count',
//            'equal_to_count',
//            'not_equal_to_count'
//        ]);
//    }

}

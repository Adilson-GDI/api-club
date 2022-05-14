<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SearchLog extends Model
{
    /**
     * @var string
     */
    protected $table = 'search_logs';

    /**
     * @var string[]
     */
    protected $fillable = [
        'search_term',
        'user_id',
        'user_type_id'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function userType(): BelongsTo
    {
        return $this->belongsTo(TypeUser::class);
    }
}

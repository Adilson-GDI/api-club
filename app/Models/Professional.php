<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    HasOne,
    BelongsTo
};

class Professional extends Model
{
    /**
     * @var string
     */
    protected $table = 'professionals';

    /**
     * @var string[]
     */
    protected $guard = ['id'];

    /**
     * @var string[]
     */
	protected $fillable = [
		'bio',
		'birthday',
		'occupation_id',
		'gender_id',
		'marital_status_id'
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'bio',
        'birthday',
        'occupation_id',
        'gender_id',
        'marital_status_id'
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'birthday'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id','user_id');
    }

    /**
     * @return HasOne
     */
    public function maritalStatus(): HasOne
    {
        return $this->hasOne(MaritalStatus::class, 'id', 'marital_status_id');
    }

    /**
     * @return HasOne
     */
    public function gender(): HasOne
    {
        return $this->hasOne(Gender::class, 'id', 'gender_id');
    }

    /**
     * @return HasOne
     */
    public function occupation(): HasOne
    {
        return $this->hasOne(Occupation::class, 'id', 'occupation_id');
    }
}

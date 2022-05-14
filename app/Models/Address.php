<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\{
    HasOne,
    BelongsTo
};

class Address extends Model
{
    /**
     * @var string[]
     */
    protected $guard = ['id'];

    /**
     * @var string
     */
    protected $table = 'addresses';

    protected $casts = [
        'city_id' => 'integer',
        'state_id' => 'integer',
        // 'options' => Json::class,
        // 'secret' => Hash::class.':sha256',
        // 'address' => Address::class,
        // 'directory' => AsStringable::class,
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'state',
        'city'
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'address',
        'number',
        'neighborhood',
        'complement',
        'complement',
        'city_id',
        'state_id',
        'latitude',
        'longitude',
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'address',
        'number',
        'neighborhood',
        'complement',
        'complement',
        'latitude',
        'longitude'
    ];

    /**
     * @return HasOne
     */
    public function state(): HasOne
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    /**
     * @return HasOne
     */
    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

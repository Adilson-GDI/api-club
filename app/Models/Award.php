<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{
    HasOne,
    hasMany
};

class Award extends Model
{
    /**
     * @var string
     */
    protected $table = 'awards';

    /**
     * @var string[]
     */
    protected $guard = ['id'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'picture',
        'size', // small, medium, large
        'date_begin',
        'date_end',
        'can_view',
        'can_redeem',
        'required_information',
        'description',
        'type_id',
        'category_id',
        'position',
        'active',
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'title',
        'subtitle',
        'slug',
        'picture',
        'size', // small, medium, large
        'date_begin',
        'date_end',
        'can_view',
        'can_redeem',
        'required_information',
        'description',
        'type_id',
        'category_id',
        'position',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array[]
     */
    protected $hidden = [];

    /**
     * @var string[]
     */
    protected $dates = [
    	'date_begin',
    	'date_end'
    ];

    /**
     * Obtem o tipo e premiação, se campanha ou rescatáveis
     *
     * @return HasOne
     */
    public function type(): HasOne
    {
        return $this->hasOne(AwardType::class, 'id', 'type_id');
    }

    /**
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(AwardCategory::class, 'id', 'category_id');
    }

    /**
     * Obtem as imagens referente a premiação
     *
     * @return HasMany
     */
    public function files(): HasMany
    {
    	return $this->hasMany(AwardFile::class);
    }

    /**
     * @return HasOne
     */
    public function landingPage(): HasOne
    {
        return $this->hasOne(AwardLandingPage::class, 'award_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function packages(): HasMany
    {
        return $this->hasMany(AwardPackage::class, 'award_id', 'id');
    }

    /**
     * @return mixed
     */
    public function scopeActivePackages(): mixed
    {
        return $this->packages->active();
    }

    /**
     * @return mixed
     */
    public function mainPackage(): mixed
    {
        return $this->packages->main();
        //retornar primeiro pacote caso nenhum esteja marcado como principal
//        return $this->hasMany(\Clubecasa\Models\AwardPackage::class, 'award_id', 'id')->where('is_main', 1)->first();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query): mixed
    {
        return $query->where('active', 1);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileLandingPage extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'profile_landing_pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_template_id',
        'user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Relation with store
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function store()
    {
        return $this->belongsTo(\Clubecasa\Models\User::class, 'user_id');
    }

    /**
     * Relation with professional
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function professional()
    {
        return $this->belongsTo(\Clubecasa\Models\User::class, 'user_id');
    }

    /**
     * Relation with Associate
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function contents()
    {
        return $this->hasMany(\Clubecasa\Models\ProfileLandingPageContent::class, 'page_id');
    }

    public function firstText()
    {
        return $this->hasMany(\Clubecasa\Models\ProfileLandingPageContent::class, 'page_id')->where('profile_template_position_id', 2)->first();
    }

    public function secondText()
    {
        return $this->hasMany(\Clubecasa\Models\ProfileLandingPageContent::class, 'page_id')->where('profile_template_position_id', 3)->first();
    }

    /**
     * Relation with Associate
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function files()
    {
        return $this->hasMany(\Clubecasa\Models\ProfileLandingPageFile::class, 'page_id');
    }

    public function firstPicture()
    {
        return $this->files()->where('profile_template_position_id', 4)->first();
    }

    public function secondPicture()
    {
        return $this->files()->where('profile_template_position_id', 5)->first();
    }

    public function carouselPictures()
    {
        return $this->files()->where('profile_template_position_id', 6)->get();
    }
}

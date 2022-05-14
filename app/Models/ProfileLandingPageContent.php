<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileLandingPageContent extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'profile_landing_page_contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id',
        'profile_template_position_id',
        'content'
    ];

    /**
     * Não obrigatóriedade dos campos de update_at e create_at
     *
     * @var boolean
     */
    public $timestamps = false;
}

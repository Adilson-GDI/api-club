<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileLandingPageFile extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'profile_landing_page_files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id',
        'profile_template_position_id',
        'file_name',
        'file_type'
    ];

    /**
     * Não obrigatóriedade dos campos de update_at e create_at
     *
     * @var boolean
     */
    public $timestamps = false;
}

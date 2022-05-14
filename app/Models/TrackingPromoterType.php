<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class TrackingPromoterType extends Model
{
    protected $table = 'tracking_promoter_types';

    protected $guard = ['id'];

    protected $fillable = [
        'name',
        'slug'
    ];

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class TrackingCampaign extends Model
{
    protected $table = 'tracking_campaigns';

    protected $guard = ['id'];

    protected $fillable = [
        'description',
        'function'
    ];

    protected $dates = [
        'date_begin',
        'date_end'
    ];
}

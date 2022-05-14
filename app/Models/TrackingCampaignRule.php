<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class TrackingCampaignRule extends Model
{
    protected $table = 'tracking_campaign_rules';

    protected $guard = ['id'];

    protected $fillable = [
        'description',
        'function'
    ];

    public $timestamps = false;
}

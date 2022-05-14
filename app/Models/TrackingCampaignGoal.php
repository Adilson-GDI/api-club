<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class TrackingCampaignGoal extends Model
{
    protected $table = 'tracking_campaign_goals';

    protected $guard = ['id'];

    protected $fillable = [
        'campaign_id',
        'campaign_rule_id',
        'parameters'
    ];

    protected $dates = [
        'date_begin',
        'date_end'
    ];
}

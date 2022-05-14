<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypeUser extends Model
{
    public $timestamps = false;

    protected $table = 'type_users';

	protected $fillable = [
		'name'
    ];

    protected $visible = [
        'id',
        'name',
        'slug'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'type_user_id', 'id');
    }
}

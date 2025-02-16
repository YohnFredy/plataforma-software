<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserData extends Model
{
    protected $fillable = [
        'user_id',
        'sex',
        'birthdate',
        'phone',
        'country_id',
        'department_id',
        'city_id',
        'city',
        'address',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

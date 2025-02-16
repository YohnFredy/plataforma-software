<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnilevelTotal extends Model
{
    protected $fillable = ['user_id', 'direct_affiliates', 'total_affiliates'];
}

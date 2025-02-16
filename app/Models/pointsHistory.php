<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pointsHistory extends Model
{
    protected $fillable = ['user_id', 'start_date', 'end_date', 'unilevel_points', 'points_left', 'points_right'];
}

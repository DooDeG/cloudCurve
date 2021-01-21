<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class curveDetail extends Model
{
    protected $fillable = [
        'GId', 'UserId','UserId', 'isActive', 'totalTime', 'accuracy'
    ];
}

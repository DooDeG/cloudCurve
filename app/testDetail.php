<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class testDetail extends Model
{
    protected $fillable = [
        'GId', 'UserId','UserId', 'isActive', 'totalTime', 'accuracy'
    ];
}

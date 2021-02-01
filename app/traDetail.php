<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class traDetail extends Model
{
    protected $fillable = [
        'id','GId', 'UserId','UserId', 'isActive', 'totalTime', 'accuracy'
    ];
}

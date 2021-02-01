<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tra extends Model
{
    protected $fillable = [
        'id','GId', 'time','UserId', 'isActive', 'totalTime', 'accuracy', 'date'
    ];
}

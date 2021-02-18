<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    protected $fillable = [
        'GId', 'time','UserId', 'isActive', 'totalTime', 'accuracy', 'date'
    ];
}

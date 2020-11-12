<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group_word extends Model
{
    protected $fillable = [
        'ENo', 'GNo','UserId', 'createTime', 'level'
    ];
}

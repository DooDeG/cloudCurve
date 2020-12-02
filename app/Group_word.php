<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group_word extends Model
{
    protected $fillable = [
        'ENo', 'GNo', 'GId', 'UserId', 'States', 'createTime', 'isActive'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group_word extends Model
{
    protected $fillable = [
        'ENo', 'GNo', 'createTime', 'level'
    ];
}

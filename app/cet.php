<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cet extends Model
{
    protected $fillable = [
        'english', 'chinese', 'sent', 'level'
    ];
}

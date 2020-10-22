<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class en_word extends Model
{
    protected $fillable = [
        'english', 'chinese', 'sent', 'level'
    ];
}

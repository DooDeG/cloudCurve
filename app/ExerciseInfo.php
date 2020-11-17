<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseInfo extends Model
{
    protected $fillable = [
        'GId', 'preparation', 'times'
    ];
}

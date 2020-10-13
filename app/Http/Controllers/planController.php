<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class planController extends Controller
{
    
    public function getAllPlan(){
       
        return response()->json(['status' => 'success'], 200);
    }

}

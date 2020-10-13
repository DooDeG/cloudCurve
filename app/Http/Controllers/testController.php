<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    public function login(){
        
        return response()->json(['status' => 'success'], 200);
    }
}

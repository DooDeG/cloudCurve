<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class indexController extends Controller
{
    public function getUser(){
        $id = Auth::id(); 
        $result = $id;
        return response()->json(['status' => 'success', 'result' => $result], 200);
    }
}

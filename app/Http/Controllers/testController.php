<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    public function test(Request $request){
        // $result = $request->select;
        // return response()->json(['status' => 'success', 'result' => $result], 200);
        return response()->json(['status' => 'success'], 200);
    }
}

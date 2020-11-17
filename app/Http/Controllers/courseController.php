<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group_word;
use Illuminate\Support\Facades\Auth;

class courseController extends Controller
{
    public function getChapter(){
        $id = Auth::id(); 
        $result = '';
        $gw = Group_word::where('UserId','=', $id)->latest()->first();
        if(!$gw){

            return response()->json(['status' => 'fail', "result" => ""], 200);
        }
        $result = $gw->GNo+1;
        return response()->json(['status' => 'success', "result" => $result], 200);
    }
}

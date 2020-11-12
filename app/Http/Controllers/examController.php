<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\en_word;
use App\Group_word;

class examController extends Controller
{
    public function getWords(){

        $id = Auth::id(); 

        $gw = Group_word::where('UserId','=', $id)->count();
        $maxgw = $gw+20;
        $result = '';
        $result = en_word::where('id', '>', $gw)->where('id', '<=', $maxgw)->get();
        
        foreach($result as $item){
            unset($item->level);
        }
        return response()->json(['status' => 'success', "result" => $result], 200);
    }

    public function getExerciseWords(){

        $id = Auth::id(); 

        $gw = Group_word::where('UserId','=', $id)->count();
        $maxgw = $gw+20;
        $result = '';
        $result = en_word::where('id', '>', $gw)->where('id', '<=', $maxgw)->get();
        
        foreach($result as $item){
            unset($item->level);
        }
        return response()->json(['status' => 'success', "result" => $result], 200);
    }
}

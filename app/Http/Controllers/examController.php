<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\en_word;
use App\Group_word;
use Auth;

class examController extends Controller
{
    public function getWords(){

        $gw = Group_word::count();
        $maxgw = $gw+20;
        $result = '';
        $result = en_word::where('id', '>', $gw)->where('id', '<=', $maxgw)->get();
        
        foreach($result as $item){
            unset($item->level);
        }
        return response()->json(['status' => 'success', "result" => $result], 200);
    }
}

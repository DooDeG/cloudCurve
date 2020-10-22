<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\en_word;
use App\Group_word;
use Auth;

class examController extends Controller
{
    public function getWords(){

        $tw = en_word::all();
        $item = 20;

        // $gw = Group_word::all();
        $gw = Group_word::count();
        $result = '';
        // if(empty($gw)){
        //     $result = en_word::where('id', '<', '21')->get();
        // }else{
        //     $result = '1234';
        // };

        // if(gettype($gw)){
        //     $result = en_word::where('id', '<', '21')->get();
        // }else{
        //     $result = '1234';
        // };
        if($gw == 0){
            $result = en_word::where('id', '<=', '20')->get();
            unset($result->id);
            unset($result->level);
            foreach($result as $item){
                unset($item->level);
                unset($item->id);
            }
        }else{
            $result = '1234';
        };



        
        return response()->json(['status' => 'success', "result" => $result], 200);
    }
}

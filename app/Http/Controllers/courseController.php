<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group_word;
use App\en_word;
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
    public function getAllList(){
        $id = Auth::id(); 
        $result = [];
        $gw = en_word::count();
        $maxNo = 20;
        $minNo = 0;
        $no = 1;
        $tmpGroup = [];
        // for ($x = 1; $x <= 5; $x++) {
        //     for ($y = 1; $y <= 10; $y++) {
        //         $tmp = en_word::where('id', '>', $minNo)->where('id', '<=', $maxNo)->select('id', 'english', 'chinese', 'level')->get();
        //         $maxNo +=20;
        //         $minNo +=20;
        //         $no +=1;
        //         array_push($tmpGroup, $tmp);
        //         array_push($tmpGroup, $no);
        //     }
        //     array_push($result, $tmpGroup);
        //     $tmpGroup=[];
        // }
        for($x = 1; $x <= 50; $x++){
            array_push($tmpGroup, $x);
        }
        $result = $tmpGroup;
        if(!$result){

            return response()->json(['status' => 'fail', "result" => ""], 200);
        }
        return response()->json(['status' => 'success', "result" => $result], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group_word;
use App\en_word;
use Illuminate\Support\Facades\Auth;
Use DB;
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
        $tmp = [];
        
        $no = 0;
        $gw = Group_word::where('UserId','=', $id)
                        ->select( 'GNo',)
                        // ->select(DB::raw('count(*) as GId'))
                        // ->select('GId', 'GNo')
                        // ->where('GId', '>', 1)
                        // ->groupBy('GNo')
                        
                        // ->select('GId')

                        ->groupByRaw('GNo')
                        ->get();
        $x ='';
        foreach ($gw as $item) {
            $x = Group_word::where('UserId','=', $id)
                            ->where('GNo', '=', $item->GNo)
                            ->select('GNo', 'States')
                            ->first();
            array_push($tmp, $x);
        }
        for($x = 1; $x <= 50; $x++){
            if($no > count($tmp)-1){
                array_push($tmpGroup, ["id"=>$x, 'status'=>[]]);
            }else{
                array_push($tmpGroup, [ "id"=>$x, 'status'=>$tmp[$no]]);
            }
            $no ++;
        }
        // $result["chapter"] = $tmpGroup;
        // $result["gw"] = $gw;
        $result = $tmpGroup;
        // if(!$result){

        //     return response()->json(['status' => 'fail', "result" => ""], 200);
        // }
        return response()->json(['status' => 'success', "result" => $result], 200);
    }
}

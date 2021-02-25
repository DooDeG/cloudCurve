<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\en_word;
use App\group_word;
use App\curve;
use App\curveDetail;
use App\tra;
use App\traDetail;
use App\test;
use App\testDetail;

class viusalizationController extends Controller
{
    public function getFinshWord(){
        $id = Auth::id();
        $FNo = group_word::where('UserId','=', $id)
                        // ->where('States', '=', '')
                        ->count();
        $result = $FNo;
        return response()->json(['status' => 'success', 'result' => $result], 200);  
    }
    public function getTodayReviewDataVis(){
        $id = Auth::id();
        $day = date("Y-m-d");
        $data = curve::where('UserId','=', $id)->where('date','=', $day)->where('time','!=', 0)->get();
        $result = array();
        $check = array();
        foreach($data as $item){
            if (in_array($item->GId, $check)){  
                } 
            else{ 
                array_push($check, $item->GId);
                array_push($result, $item);

            } 
        }
        return response()->json(['status' => 'success', 'result' => $result], 200);       

    }
    public function getTestReviewDataVis(){
        $id = Auth::id();
        $day = date("Y-m-d");
        $data = curve::where('UserId','=', $id)->where('date','=', $day)->where('time','!=', 0)->get();
        $result = array();
        $check = array();
        foreach($data as $item){
            if (in_array($item->GId, $check)){  
                } 
            else{ 
                array_push($check, $item->GId);
                array_push($result, $item);

            } 
        }
        return response()->json(['status' => 'success', 'result' => $result], 200);       

    }
    public function getTestVis(){
        $id = Auth::id();
        $day = date("Y-m-d");
        $data = test::where('UserId','=', $id)->where('date','=', $day)->where('time','=', 1)->get();
        $result = array();
        $check = array();
        foreach($data as $item){
            if (in_array($item->GId, $check)){  
                } 
            else{ 
                array_push($check, $item->GId);
                array_push($result, $item);

            } 
        }
        return response()->json(['status' => 'success', 'result' => $result], 200);   
        
        // $id = Auth::id();

        // $day = date("Y-m-d");
        // $data = test::where('UserId','=', $id)->where('time','=', 1)->get();
        // $result = array();
        // $check = array();
        // foreach($data as $item){
        //     if (in_array($item->GId, $check)){  
        //         } 
        //     else{ 
        //         array_push($check, $item->GId);
        //         array_push($result, $item);

        //     } 
        // }
        
        // $lesson1 = $id."G"."1";
        // $da = curve::where('UserId','=', $id)->where('GId','=', $lesson1)->get();
        // $result2 = [];
        // foreach($da as $item){
            
        //     array_push($result2, $item);
        // }
        // foreach($result as $item){
            
        //     array_push($result2, $item);
        // }
        // return response()->json(['status' => 'success', 'result' => $result, 'lesson1' =>$result2], 200);       

    }
}

<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\en_word;
use App\group_word;
use App\curve;
use App\curveDetail;

class curveController extends Controller
{
    public function getForgettingCurve(){

        $id = Auth::id(); 
        if($id == null){
            return response()->json(['status' => 'fail'], 200);
        }
        $time = [1, 2, 4, 7, 15, 30];

        $group = curve::where('UserId','=', $id)->get();
        $les = [];
        $les['day'] = [];
        $les['id'] = [];
        $result = [];
        foreach($group as $item){
            $end = $item->date;
            $start = date("Y-m-d");

            $datetime_start = new DateTime($start);
            $datetime_end = new DateTime($end);
            $days = $datetime_start->diff($datetime_end)->days;
            // return response()->json(['status' => $days], 200);
            
            if(in_array($days, $time)){
                
                $les['day'] = [$days];
                $les['id'] = [$item->GId];
                array_push($result, $les);
                
            }
        }
        
        return response()->json(['status' => 'success', 'result' => $result], 200);
        
        
        
    }
    public function getCurveData(Request $request){
        if(isset($request) && $request != null && isset($request->slug) && $request->slug != null){
            $amount = [20, 10, 5, 5, 5, 5];
            $tmp = array_reverse([$request->slug]);
            
            foreach($request->slug as $item){
                $tmp = curveDetail::where('GId','=', $item)->get();
                
                
            }
            // return response()->json(['status' => gettype([$request->slug])], 200);
            return response()->json(['status' => $request->slug], 200);
        }else{
            
            return response()->json(['status' => 'fail'], 200);
        }
        
    }
    
}

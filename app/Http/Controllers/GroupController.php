<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\en_word;
use App\group_word;

use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function saveGroupWorld(Request $request){

        $id = Auth::id(); 
        $totalGroup = group_word::where('UserId','=', $id)->count();
        
        $currentGNo = intval($totalGroup/20+1);
        $NextGNo = $currentGNo+1;
        if(isset($request) && $request != null && isset($request->wId) && $request->wId != null){
            $GNoCheck = group_word::where('GNo', '=', $NextGNo)->where('UserId','=', $id)->first();
            
            if($GNoCheck){
                return response()->json(['status' => 'success save in before'], 200);
            }
            
            foreach($request->wId as $item){
                
                $ENoCheck = group_word::where('ENo', '=', $item)->where('UserId','=', $id)->first();
                
                if(!$ENoCheck && $ENoCheck == null){
                    $group = new group_word();
                    $group->ENo = $item;
                    $group->GId = $id.'G'.$currentGNo;
                    $group->GNo = $currentGNo;
                    $group->UserId = $id;
                    $group->States = "undo";
                    $group->isActive = "1";
                    $group->createTime = date("Y-m-d H:i:s");
                    $group->save();
                }
            }
            return response()->json(['status' => 'success'], 200);
        }
        return response()->json(['status' => 'fail to get id'], 200);
    }

    public function saveGroupStates(Request $request){

        $id = Auth::id(); 
        
        if(isset($request) && $request != null && isset($request->wId) && $request->wId != null){
            foreach($request->wId as $item){
                group_word::where('UserId','=', $id)->where('ENo', '=', $item)->update([
                    'States' => $request->states,
                ]);
            }
            return response()->json(['status' => 'success'], 200);
        }else{
            
            return response()->json(['status' => 'fail'], 200);
        }
    }
    public function getFinshWord(){
        $id = Auth::id();
        $FNo = group_word::where('UserId','=', $id)
                        // ->where('States', '=', '')
                        ->count();
        $result = $FNo;
        return response()->json(['status' => 'success', 'result' => $result], 200);  
    }
}

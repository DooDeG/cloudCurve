<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\en_word;
use App\group_word;
use App\curve;
use App\curveDetail;
use App\tra;
use App\traDetail;

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
            // $gid = $id.'G'.$request->slug;
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

                    // $CheckD = curveDetail::where('GId','=', $gid)->where('ENo', '=', $item)->first();
                    // if(!$CheckD && $CheckD == null){
                    //     $dr = new curveDetail();
                    //     $dr->GId = $gid;
                    //     $dr->ENo = $item;
                    //     $dr->time = 0;
                    //     // $dr->totalTime = "";
                    //     // $dr->accuracy = "";
                    //     $dr->isActive = "1";
                    //     $dr->date = date("Y-m-d H:i:s");
                    //     $dr->save();
                    // }
                } 
            }
        
            
            // $Check = curve::where('GId','=', $gid)->first();
                
            // if(!$Check && $Check == null){
            //     $cu = new curve();
            //     $cu->GId = $gid;
            //     $cu->time = 0;
            //     $cu->isActive = "1";
            //     // $cu->totalTime = "";
            //     // $cu->accuracy = "";
            //     $cu->date = date("Y-m-d H:i:s");
            //     $cu->save();
            // }
            return response()->json(['status' => 'success'], 200);
        }
        return response()->json(['status' => 'fail to get id'], 200);
    }

    public function saveGroupStates(Request $request){

        $id = Auth::id(); 
        
        $gid = $id.'G'.$request->slug;
        if(isset($request) && $request != null && isset($request->wId) && $request->wId != null){
            foreach($request->wId as $item){
                group_word::where('UserId','=', $id)->where('ENo', '=', $item)->update([
                    'States' => $request->states,
                ]);

                // $CheckCurve = curveDetail::where('GId','=', $gid)->where('ENo', '=', $item)->where('time', '=', 0)->first();
                
                // if(!$CheckCurve && $CheckCurve == null){
                //     $dr = new curveDetail();
                //     $dr->GId = $gid;
                //     $dr->ENo = $item;
                //     $dr->UserId = $id;
                //     $dr->time = 0;
                //     $dr->totalTime = 0;
                //     $dr->accuracy = 0;
                //     $dr->isActive = "1";
                //     $dr->date = date("Y-m-d H:i:s");
                //     $dr->save();

                // }
                $CheckCurve = curveDetail::where('GId','=', $gid)->where('ENo', '=', $item)->first();
                if(!$CheckCurve && $CheckCurve == null){

                    $dt = new curveDetail();
                    $dt->GId = $gid;
                    $dt->ENo = $item;
                    $dt->UserId = $id;
                    $dt->time = 0;
                    $dt->totalTime = 0;
                    $dt->accuracy = 0;
                    $dt->isActive = "1";
                    $dt->date = date("Y-m-d H:i:s");
                    $dt->save();
                }
                
                $CheckT = traDetail::where('GId','=', $gid)->where('ENo', '=', $item)->first();
                if(!$CheckT && $CheckT == null){

                    $dt = new traDetail();
                    $dt->GId = $gid;
                    $dt->ENo = $item;
                    $dt->UserId = $id;
                    $dt->time = 0;
                    $dt->totalTime = 0;
                    $dt->accuracy = 0;
                    $dt->isActive = "1";
                    $dt->date = date("Y-m-d H:i:s");
                    $dt->save();
                }
            }
            $Check = curve::where('GId','=', $gid)->first();
                
            if(!$Check && $Check == null){
                $cu = new curve();
                $cu->GId = $gid;
                $cu->time = 0;
                $cu->UserId = $id;
                $cu->isActive = "1";
                $cu->totalTime = 0;
                $cu->accuracy = 0;
                $cu->date = date("Y-m-d H:i:s");
                $cu->save();
            }
            $Checktt = tra::where('GId','=', $gid)->first();
                
            if(!$Checktt && $Checktt == null){
                $cud = new tra();
                $cud->GId = $gid;
                $cud->time = 0;
                $cud->UserId = $id;
                $cud->isActive = "1";
                $cud->totalTime = 0;
                $cud->accuracy = 0;
                $cud->date = date("Y-m-d H:i:s");
                $cud->save();
            }
            return response()->json(['status' => 'success'], 200);
        }else{
            
            return response()->json(['status' => 'fail'], 200);
        }
    }

}

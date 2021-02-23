<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\en_word;
use App\Group_word;

use App\test;
use App\testDetail;

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
        
        
        $gw = Group_word::where('UserId','=', $id)->where('States', '=', 'undo')->first();
        if(!$gw){
            return response()->json(['status' => 'fail to get en word, user did not start learn', "result" => "undo"], 200);
        }

        $gwEn = Group_word::where('UserId','=', $id)->where('GId', '=', $gw->GId)->get();
        $result = '';
        $result = en_word::where('id', '>=', $gwEn[0]->ENo)->where('id', '<=', $gwEn[19]->ENo)->get();
        foreach($result as $item){
            unset($item->level);
        }
        
        return response()->json(['status' => 'success', "result" => $result], 200);

    }
    public function getExerciseChapter(Request $request){
        $id = Auth::id(); 
        $result = '';
        $currentDay = date("Y-m-d");
        $gw = Group_word::where('UserId','=', $id)->where('GNo', '=', $request->chap)->first();
        if(!$gw){
            return response()->json(['status' => 'success', "result" => "You should learn before exercise"], 200);
        }
        // $result = $gw->GNo;
        // return response()->json(['status' => 'success', "result" => $result], 200);
        if($gw->States == 'undo'){
            return response()->json(['status' => 'success', "result" => $gw->States], 200);
        }else if($gw->States == 'done'){
            return response()->json(['status' => 'success', "result" => $gw->States], 200);
        }
        
        return response()->json(['status' => $gw], 200);
    }

    public function getExercise(){
        $id = Auth::id(); 
        //1 2 6 12 20
        $result = '';
        $gw = Group_word::where('UserId','=', $id)->where('States', '=', 'done')->select('GId')->groupByRaw('GId')->get();
        // return response()->json(['status' => 'success', "result" => $gw], 200);
        $result =[];
        $currentNo = 0;
        $currentDay = date("Y-m-d");
        foreach($gw as $item){
            $tm = "";
            $temp = Group_word::where('GId','=', $item->GId)->select('ENo','GNo','GId', 'createTime')->first();
                if($result == null || $result == []){
                    $tm = abs((strtotime(date("Y-m-d"))-strtotime($temp->createTime))/86400);
                    if($tm == 1 || $tm == 3 || $tm == 6 || $tm == 12 || $tm == 20){
                        $temp->ENo = $tm;
                        array_push($result, $temp);
                    }
                }else if($result[$currentNo] != $temp ){
                    $tm =strtotime($currentDay) - strtotime($temp->createTime)/86400;
                    if($tm == 1 || $tm == 3 || $tm == 6 || $tm == 12 || $tm == 20){
                        $temp->ENo = $tm;
                        array_push($result, $temp);
                        $currentNo ++;
                    }
                }
            }
        
         return response()->json(['status' => 'success', "result" => $result], 200);
    }
    public function getReviewListWithId(Request $request){
        $id = Auth::id(); 
        $result = [];
        $maxgw = $request->slug*20;

        if(isset($request) && $request != null && isset($request->slug) && $request->slug != null){
            $result = en_word::where('id', '>', $maxgw-20)->where('id', '<=', $maxgw)->get();
        
            foreach($result as $item){
                unset($item->level);
            }
            return response()->json(['status' => 'success', "result" => $result], 200);
        }else{
            return response()->json(['status' => 'fail'], 200);

        }
    }

    public function getExamData(){
        $id = Auth::id(); 
        $result = [];
        $result = en_word::where('id', '>', 0)->where('id', '<=', 20)->get();
        
        $GId = $id."G"."1";
        return response()->json(['status' => 'success', "result" => $result, "GId" => $GId], 200);
        
    }

    function updatetestInfo(Request $request){
        // return response()->json(['status' => 'success', 'LessonDetail' => $request->LessonDetail, 'LessonData' => $request->LessonData], 200); 
        
        if(isset($request) && $request != null){

            $id = Auth::id(); 
            foreach($request->LessonData as $item){
                
                // $break = curve::where('GId','=', $item['GId'])->latest()->first();
                // if($break){
                //     return response()->json(['status' => 'success', 'LessonDetail' => $request->LessonDetail, 'LessonData' => $request->LessonData], 200); 
        
                // }
                $cu = new test();
                $cu->GId = $item['GId'];
                $ti = test::where('GId','=', $item['GId'])->latest()->first();
                
                // $cu->time = $item['time']+1;
                $cu->time = 1;
                $cu->totalTime = $item['totalTime'];
                $cu->UserId = $id;
                $cu->isActive = "1";
                $cu->accuracy = round($item['rate'],2);
                $cu->date = date("Y-m-d H:i:s");
                $cu->save();
            }
            
            $totaltimeTmp = 0;
            $totalRate = 0;
            $tmpGId = '';
            $tmpENo = '';
            $tmpTime = 0;
            foreach($request->LessonDetail as $item){
                foreach($item as $it){
                    $totaltimeTmp += $it['totalTime'];
                    $totalRate += $it['rate'];
                    
                    $tmpGId = $it['GId'];
                    $tmpENo = $it['Eno'];
                    $tmpTime = $it['time'];

                }
                $dr = new testDetail();
                
                $dr->ENo = $tmpENo;
                $dr->GId = $tmpGId;
                $dr->UserId = $id;
                $dr->time = 1;
                $dr->totalTime = $totaltimeTmp;
                $dr->accuracy = $totalRate / 2;
                $dr->isActive = "1";
                $dr->date = date("Y-m-d H:i:s");
                $dr->save();
                $totaltimeTmp = 0;
                
                
            }
            return response()->json(['status' => 'success'], 200);
        }else{
            
            return response()->json(['status' => 'fail'], 200);
        }
    }
    
    
}

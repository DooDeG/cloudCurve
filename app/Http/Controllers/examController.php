<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\en_word;
use App\Group_word;

use App\test;
use App\testDetail;
use App\curve;
use App\curveDetail;
use App\tra;
use App\traDetail;

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
        if($id == null){
            return response()->json(['status' => 'fail'], 200);
        } 
        $group = curve::where('UserId','=', $id)->where('time','=', 0)->where('date','!=', date("Y-m-d"))->get()->toArray();
        $data = [];
        $tmpNum = 0;
        // $group = array_reverse($group);
        $len = count($group);
        $list = [];
        $randomList = [];
        foreach($group as $item){
            $tmpArray = [];
            array_push($tmpArray, $item['GId']);
            $randomList[$item['GId']] = [];
            array_push($randomList[$item['GId']], $item['GId'], 0);
            // for ($i = 1; $i <= $len; $i++) {
            //     array_push($tmpArray, $tmpNum);
            //     array_push($list, $tmpNum);
            //     $tmpNum ++;
            // }
            array_push($tmpArray, $tmpNum);
            array_push($list, $tmpNum);
            $tmpNum ++;
            $data[$item['GId']] = $tmpArray;
            $len --;
        }
        
        $countTotalNum = count($group) * 20;
        $num = 0;
        $count = 1;
        
        $tm = [];
        $record = [];
        
        while($count<=50){
            if($count > $countTotalNum){
                break;
            }
            if(count($list)==0 || $list== null || $list==[]){
                break;
            }
            // $num = random_int(0, $tmpNum);
            $num = random_int(0, count($list)-1);
            if($list[$num]){

            }
            $num = $list[$num];
            foreach($data as $item){
                if(in_array($num, $item)){
                    if($randomList[$item[0]][1] >=20){
                        

                        $list = array_diff($list,$item);
                        $list = array_values($list);
                        continue;
                    }else{
                        
                        $randomList[$item[0]][1] ++;
                        $count ++;
                    }
                    
                    array_push($record, $list);

                }
                
            }
        }
        
        

        // return response()->json(['data' => $data,'$list'=> $list, 
        //                         'countTotalNum' => $countTotalNum, 
        //                         'randomList' => $randomList, 
        //                         'record' => $record,
        //                         'count' => $count,
        //                         'date now' => now()], 200);
        $r=0;
        $tmpGId = [];
        $result = [];
        foreach($randomList as $item){ 
            $tmpEn = curveDetail::where('GId','=', $item[0])->where('time','=', 0)->inRandomOrder()->limit($item[1])->get();
            // return response()->json(['status' => $tmpEn], 200);
            
            foreach($tmpEn as $i){
                // return response()->json(['status' => $i], 200);
                $les = [];
                // $les['day'] = [];
                $les['id'] = [];
                $les['Word'] = [];
                $les['time'] = [];
                // $les['day'] = $days;
                $les['id'] = $i->GId;
                $les['time'] = $i->time;
                array_push($tmpGId, $i->ENo);
                $d = en_word::where('id','=', $i->ENo)->first();
                // return response()->json(['status' => $data, 'statuss' => $tmpGId], 200);
                $ti = traDetail::where('UserId','=', $id)->where('ENo', '=', $d->id)->latest()->first();
                $d->level = $ti->time;
                $les['Word'] = $d;
                array_push($result, $les);
                $r ++;
                // return response()->json(['status' => $result, 'GId'=>$i->GId, 'time'=>$i->time], 200);

            }     
                
                
            }
            return response()->json(['status' => $data, 
                                    'result' => $result, 
                                    'r' => $r, 
                                    'randomList' => $randomList,
                                    'tmpGId' => $tmpGId], 200);
                            
    
    }
    public function getExamDataCopy(){
        
        $id = Auth::id(); 
        if($id == null){
            return response()->json(['status' => 'fail'], 200);
        }

        $group = curve::where('UserId','=', $id)->where('time','=', 0)->where('date','!=', date("Y-m-d"))->get()->toArray();
        // return response()->json(['status' => $group], 200);
        if($id == null){
            return response()->json(['status' => 'fail'], 200);
        }
        $len = count($group);
        
        $data = [];
        $tmpNum = 0;
        $group = array_reverse($group);
        $countTotalNum = 0;
        $randArr = [];
        foreach($group as $item){
            $countTotalNum ++;
            $tmpArray = [];
            //
            $tmpRandomArray = [];
            $tmpRandomArray[$item['GId']] = 0;
            $tmpRandomArray['GId'] = $item['GId'];

            // $randArr[$item['GId']] = 0;
            $randArr[$item['GId']] = $tmpRandomArray;
            //
            // array_push($randArr, $tmpRandomArray);
            array_push($tmpArray, $item['GId']);
            // for ($i = 1; $i <= $len; $i++) {
                array_push($tmpArray, $tmpNum);
            //     $tmpNum ++;
            // }
            $tmpNum ++;
            $data[$item['GId']] = $tmpArray;
            $len --;
        }
        // return response()->json(['data' => $data,'group' => $group,], 200);

        $les = [];
        $les['day'] = [];
        $les['id'] = [];
        $les['Word'] = [];
        $les['time'] = [];
        $ENo = [];
        $result = [];
        
        $tmpGId = [];
        $tmpNum--;
        $r = 0;

        $countTotalNum = $countTotalNum *20;
        // $group = curve::where('UserId','=', $id)->where('time','=', 0)->get()->toArray();

        //
        // return response()->json(['data' => $data,'data' => $countTotalNum,], 200);
        $repeatArray = [];
        $num =-1;      

        

        for ($i = 1; $i <= 50; $i++) {
            // if($i > $tmpNum){
            //     break;
            // }
            if($i > $countTotalNum){
                break;
            }
            $repeat = true;
            while($repeat){
                
                $num = $this->randWithout(0, $tmpNum, $repeatArray);
                
                foreach($data as $item){
                    
                    if(in_array($num, $item)){
                        
                        $randArr[$item[0]][$item[0]] ++;
                        $repeat = false;
                        if($randArr[$item[0]][$item[0]] == 20){
                            foreach($item as $ddddd){
                                array_push($repeatArray, $ddddd);
                            }
                            
                        }
                        break;
                    }
                }

            }
            
            
        }
                        
        // return response()->json([gettype($randArr[0])], 200); 
                
        //return response()->json(['status' => $data, 'randArr' => $randArr, 'repeatArray' => $repeatArray], 200);
        foreach($randArr as $item){ 
            // $pd = settype($item, "int");
        // return response()->json(['status' => $data, 'randArr' => $randArr,'item'=>$item['GId'], 'gid' =>array_keys($randArr, $item)], 200);
            $tmpEn = curveDetail::where('GId','=', $item['GId'])->where('time','=', 0)->inRandomOrder()->limit($item[$item['GId']])->get();
            
            foreach($tmpEn as $i){
                $les = [];
                // $les['day'] = [];
                $les['id'] = [];
                $les['Word'] = [];
                $les['time'] = [];
                // $les['day'] = $days;
                $les['id'] = $i->GId;
                $les['time'] = $i->time;
                array_push($tmpGId, $i->ENo);
                $d = en_word::where('id','=', $i->ENo)->first();
                // return response()->json(['status' => $data, 'statuss' => $tmpGId], 200);
                $ti = curveDetail::where('UserId','=', $id)->where('ENo', '=', $d->id)->latest()->first();
                $d->level = $ti->time;
                $les['Word'] = $d;
                array_push($result, $les);
                $r ++;
                // return response()->json(['status' => $result, 'GId'=>$i->GId, 'time'=>$i->time], 200);

            }     
            
            
        }
        return response()->json(['status' => $data, 'result' => $result, 'r' => $r, 'tmpGId' => $tmpGId], 200);

        
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
                $dr->time = $tmpTime+1;
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

    function randWithout($from, $to, array $exceptions) {
        sort($exceptions); // lets us use break; in the foreach reliably
        $number = rand($from, $to - count($exceptions)); // or mt_rand()
        foreach ($exceptions as $exception) {
            if ($number >= $exception) {
                $number++; // make up for the gap
            } else /*if ($number < $exception)*/ {
                break;
            }
        }
        return $number;
    }
    
    
}

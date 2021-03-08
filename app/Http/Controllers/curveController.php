<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\en_word;
use App\group_word;
use App\curve;
use App\curveDetail;
use App\tra;
use App\traDetail;

class curveController extends Controller
{
    public function getTodayReviewDataCopy(){

        $id = Auth::id(); 
        if($id == null){
            return response()->json(['status' => 'fail'], 200);
        }
        $time = [1, 2, 4, 7];

        $group = curve::where('UserId','=', $id)->where('time','=', 0)->get();
        $les = [];
        $les['day'] = [];
        $les['id'] = [];
        $les['Word'] = [];
        $les['time'] = [];
        $ENo = [];
        $result = [];
        foreach($group as $item){
            $end = $item->date;
            $start = date("Y-m-d");

            $datetime_start = new DateTime($start);
            $datetime_end = new DateTime($end);
            $days = $datetime_start->diff($datetime_end)->days;
            
            if(in_array($days, $time)){
                $les['day'] = $days;
                $les['id'] = $item->GId;
                $les['time'] = $item->time;
                
                //base on accuracy order
                // $tmp = curveDetail::where('GId','=', $item->GId)->where('time','=', 0)->get()->toArray();
                // $num = $this->reviewWord($tmp, $days);
                // array_multisort(array_column($tmp,'accuracy'),SORT_ASC,$tmp);
                //base on accuracy, sort of accuracy rate, if rate less, then priority select

                //base on random order
                $tmp = curveDetail::where('GId','=', $item->GId)->where('time','=', 0)->inRandomOrder()->get()->toArray();
                $num = $this->reviewWord($tmp, $days);
                
                //base on random order
                
                
                $n = 0;
                foreach($tmp as $item){
                    if($n == $num){
                        break;
                    }else{
                        $d = en_word::where('id','=', $item['ENo'])->first();
                        // unset($d->id);
                        unset($d->level);
                        unset($d->created_at);
                        unset($d->updated_at);
                        
                        $ti = curveDetail::where('UserId','=', $id)->where('ENo', '=', $d->id)->latest()->first();
                        // return response()->json(['status' => 'success', 'result' => $time], 200);
                        $d->level = $ti->time;
                        
                        // array_push($d, $item['time']);
                        $n ++;
                        $les['Word'] = $d;
                        array_push($result, $les);
                        
                    }
                }
                $les['day'] = [];
                $les['id'] = [];
                $les['Word'] = [];
                $les['time'] = [];
                $les = [];
            }
        }
        $result = array_reverse($result);
        return response()->json(['status' => 'success', 'result' => $result], 200);
        
        
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
    public function getTodayReviewData(){
        $id = Auth::id();
        if($id == null){
            return response()->json(['status' => 'fail'], 200);
        } 
        $group = curve::where('UserId','=', $id)->where('time','=', 0)->where('date','!=', date("Y-m-d"))->get()->toArray();
        $data = [];
        $tmpNum = 0;
        $group = array_reverse($group);
        $len = count($group);
        $list = [];
        $randomList = [];
        foreach($group as $item){
            $tmpArray = [];
            array_push($tmpArray, $item['GId']);
            $randomList[$item['GId']] = [];
            array_push($randomList[$item['GId']], $item['GId'], 0);
            for ($i = 1; $i <= $len; $i++) {
                array_push($tmpArray, $tmpNum);
                array_push($list, $tmpNum);
                $tmpNum ++;
            }
            $data[$item['GId']] = $tmpArray;
            $len --;
        }
        $countTotalNum = count($group) * 20;
        $num = 0;
        $count = 1;
        
        $tm = [];
        $record = [];
        $record12 = 0;
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
                        $record12 ++;
                        continue;
                    }else{
                        
                        $randomList[$item[0]][1] ++;
                        array_push($record, $num);
                        $count ++;
                    }
                    

                }
                
            }
        }
        
        

        // return response()->json(['data' => $data,'$list'=> $list, 
        //                         'countTotalNum' => $countTotalNum, 
        //                         'randomList' => $randomList, 
        //                         'record' => $record,
        //                         'count' => $count,
        //                         '$record12' => $record12,
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
    // public function getTodayReviewData(){

    //     $id = Auth::id(); 
    //     if($id == null){
    //         return response()->json(['status' => 'fail'], 200);
    //     }

    //     $group = curve::where('UserId','=', $id)->where('time','=', 0)->where('date','!=', date("Y-m-d"))->get()->toArray();
    //     // return response()->json(['status' => $group], 200);
    //     if($id == null){
    //         return response()->json(['status' => 'fail'], 200);
    //     }
    //     $len = count($group);
        
    //     $data = [];
    //     $tmpNum = 0;
    //     $group = array_reverse($group);
    //     $countTotalNum = 0;
    //     $randArr = [];
    //     foreach($group as $item){
    //         $countTotalNum ++;
    //         $tmpArray = [];
    //         //
    //         $tmpRandomArray = [];
    //         $tmpRandomArray[$item['GId']] = 0;
    //         $tmpRandomArray['GId'] = $item['GId'];

    //         // $randArr[$item['GId']] = 0;
    //         $randArr[$item['GId']] = $tmpRandomArray;
    //         //
    //         // array_push($randArr, $tmpRandomArray);
    //         array_push($tmpArray, $item['GId']);
    //         for ($i = 1; $i <= $len; $i++) {
    //             array_push($tmpArray, $tmpNum);
    //             $tmpNum ++;
    //         }
    //         $data[$item['GId']] = $tmpArray;
    //         $len --;
    //     }
    //     // return response()->json(['data' => $data,'group' => $group,], 200);

    //     $les = [];
    //     $les['day'] = [];
    //     $les['id'] = [];
    //     $les['Word'] = [];
    //     $les['time'] = [];
    //     $ENo = [];
    //     $result = [];
        
    //     $tmpGId = [];
    //     $tmpNum--;
    //     $r = 0;

    //     $countTotalNum = $countTotalNum *20;
    //     // $group = curve::where('UserId','=', $id)->where('time','=', 0)->get()->toArray();

    //     //
    //     // return response()->json(['data' => $data,'data' => $countTotalNum,], 200);
    //     $repeatArray = [];
    //     $num =-1;      

    //     // $tmpData = [];
    //     // foreach($data as $item){
    //     //     foreach($item as $i){
    //     //         array_push($tmpData, $i);

    //     //     }
    //     // }
    //     // return response()->json(['status' => $tmpData], 200);

    //     for ($i = 1; $i <= 50; $i++) {
    //         // if($i > $tmpNum){
    //         //     break;
    //         // }
    //         if($i > $countTotalNum){
    //             break;
    //         }
    //         $repeat = true;
    //         while($repeat){
    //             // if($num == -1 || in_array($num, $repeatArray)){
                    
    //             //     continue;
    //             // }else{
                    
    //             //     $num = random_int(0, $tmpNum);
    //             // }
    //             // $num = random_int(0, $tmpNum);
    //             $num = $this->randWithout(0, $tmpNum, $repeatArray);
    //             // return response()->json(['select num' => $num], 200);
    //             // continue;
    //             foreach($data as $item){
                    
    //                 if(in_array($num, $item)){
                        
    //                     $randArr[$item[0]][$item[0]] ++;
    //                     $repeat = false;
    //                     if($randArr[$item[0]][$item[0]] == 20){
    //                         foreach($item as $ddddd){
    //                             array_push($repeatArray, $ddddd);
    //                         }
                            
    //                         //return response()->json(['item' => $repeatArray,'data' => $data,'select num' => $num, 'result2222' => $randArr[$item[0]]], 200);
                        
                            
    //                     }
    //                     //return response()->json(['item' => $item,'data' => $data,'select num' => $num, 'result2222' => $randArr[$item[0]][$item[0]] ], 200);
    //                     break;
    //                 }
    //             }

    //         }
            
            
    //     }
                        
    //     // return response()->json([gettype($randArr[0])], 200); 
             
    //     //return response()->json(['status' => $data, 'randArr' => $randArr, 'repeatArray' => $repeatArray], 200);
    //     foreach($randArr as $item){ 
    //         // $pd = settype($item, "int");
    //     // return response()->json(['status' => $data, 'randArr' => $randArr,'item'=>$item['GId'], 'gid' =>array_keys($randArr, $item)], 200);
    //         $tmpEn = curveDetail::where('GId','=', $item['GId'])->where('time','=', 0)->inRandomOrder()->limit($item[$item['GId']])->get();
            
    //         foreach($tmpEn as $i){
    //             $les = [];
    //             // $les['day'] = [];
    //             $les['id'] = [];
    //             $les['Word'] = [];
    //             $les['time'] = [];
    //             // $les['day'] = $days;
    //             $les['id'] = $i->GId;
    //             $les['time'] = $i->time;
    //             array_push($tmpGId, $i->ENo);
    //             $d = en_word::where('id','=', $i->ENo)->first();
    //             // return response()->json(['status' => $data, 'statuss' => $tmpGId], 200);
    //             $ti = curveDetail::where('UserId','=', $id)->where('ENo', '=', $d->id)->latest()->first();
    //             $d->level = $ti->time;
    //             $les['Word'] = $d;
    //             array_push($result, $les);
    //             $r ++;
    //             // return response()->json(['status' => $result, 'GId'=>$i->GId, 'time'=>$i->time], 200);

    //         }     
            
           
    //     }
    //     //
    //     // for ($i = 1; $i <= 50; $i++) {
    //     //     // if($i > $tmpNum){
    //     //     //     break;
    //     //     // }
    //     //     if($i > $countTotalNum){
    //     //         break;
    //     //     }
    //     //     $num = random_int(0, $tmpNum);

    //     //     // return response()->json(['status' => $data, 'result2222' => random_int(0, $tmpNum)], 200);
    //     //     foreach($data as $item){
    //     //         if(in_array($num, $item)){
    //     //             // return response()->json(['status' => array_keys($data, $item),'statuss' => $item,'statusss' => $data], 200);
                    
    //     //             $reply = -1;
    //     //             while($reply){
    //     //                 $tmpEn = curveDetail::where('GId','=', array_keys($data, $item))->where('time','=', 0)->inRandomOrder()->limit(1)->get();
                        
    //     //                 // $tmpEn = curveDetail::where('GId','=', array_keys($data, $item))->where('time','=', 0)->inRandomOrder()->first();
                        
    //     //                 // return response()->json(['status' => $tmpEn[0]->GId, $tmpGId], 200);

    //     //                 // if(in_array($tmpEn[0]->ENo, $tmpGId)){
                            
    //     //                 //     // $reply ++;
                            
    //     //                 // }else{
    //     //                 //     $les = [];
    //     //                 //     // $les['day'] = [];
    //     //                 //     $les['id'] = [];
    //     //                 //     $les['Word'] = [];
    //     //                 //     $les['time'] = [];
    //     //                 //     // $les['day'] = $days;
    //     //                 //     $les['id'] = $tmpEn[0]->GId;
    //     //                 //     $les['time'] = $tmpEn[0]->time;
    //     //                 //     array_push($tmpGId, $tmpEn[0]->ENo);
    //     //                 //     $d = en_word::where('id','=', $tmpEn[0]->ENo)->first();
    //     //                 //     // return response()->json(['status' => $data, 'statuss' => $tmpGId], 200);
    //     //                 //     $ti = curveDetail::where('UserId','=', $id)->where('ENo', '=', $d->id)->latest()->first();
    //     //                 //     $d->level = $ti->time;
    //     //                 //     $les['Word'] = $d;
    //     //                 //     array_push($result, $les);
    //     //                 //     $reply ++;
    //     //                 //     $r ++;

    //     //                 // }
    //     //                 $les = [];
    //     //                     // $les['day'] = [];
    //     //                     $les['id'] = [];
    //     //                     $les['Word'] = [];
    //     //                     $les['time'] = [];
    //     //                     // $les['day'] = $days;
    //     //                     $les['id'] = $tmpEn[0]->GId;
    //     //                     $les['time'] = $tmpEn[0]->time;
    //     //                     array_push($tmpGId, $tmpEn[0]->ENo);
    //     //                     $d = en_word::where('id','=', $tmpEn[0]->ENo)->first();
    //     //                     // return response()->json(['status' => $data, 'statuss' => $tmpGId], 200);
    //     //                     $ti = curveDetail::where('UserId','=', $id)->where('ENo', '=', $d->id)->latest()->first();
    //     //                     $d->level = $ti->time;
    //     //                     $les['Word'] = $d;
    //     //                     array_push($result, $les);
    //     //                     $reply ++;
    //     //                     $r ++;
    //     //                 // $reply ++;
    //     //             }
                    
    //     //             break;

                    
    //     //         }
    //     //     }
            

            
    //     // }
    //     return response()->json(['status' => $data, 'result' => $result, 'r' => $r, 'tmpGId' => $tmpGId], 200);

        
    // }
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

    public function reviewWord($data, $day){
        // base on curve day to return review data! 
        switch ($day) {
            case 1:
                return 20;
                break;
            case 2:
                return 10;
                break;
            case 4:
                return 5;
                break;
            case 7:
                return 5;
                break;
            case 15:
                return 5;
                break;
            case 30:
                return 5;
                break;
            default:
                return ;
            }
        }
        
        function array_sort($array,$keys,$type='asc'){
            //$array为要排序的数组,$keys为要用来排序的键名,$type默认为升序排序
            $keysvalue = $new_array = array();
            foreach ($array as $k=>$v){
                $keysvalue[$k] = $v[$keys];
            }
            if($type == 'asc'){
                asort($keysvalue);
            }else{
                arsort($keysvalue);
            }
                reset($keysvalue);
            foreach ($keysvalue as $k=>$v){
                $new_array[$k] = $array[$k];
            }
            return $new_array;
        }

        function updateCurveGroupInfo(Request $request){
            // return response()->json(['status' => 'success', 'LessonDetail' => $request->LessonDetail, 'LessonData' => $request->LessonData], 200); 
            
            if(isset($request) && $request != null){

                $id = Auth::id(); 
                foreach($request->LessonData as $item){
                    
                    // $break = curve::where('GId','=', $item['GId'])->latest()->first();
                    // if($break){
                    //     return response()->json(['status' => 'success', 'LessonDetail' => $request->LessonDetail, 'LessonData' => $request->LessonData], 200); 
            
                    // }
                    $cu = new curve();
                    $cu->GId = $item['GId'];
                    $ti = curve::where('GId','=', $item['GId'])->latest()->first();
                    
                    // $cu->time = $item['time']+1;
                    $cu->time = $ti->time+1;
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
                    $dr = new curveDetail();
                    
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
                    $totalRate = 0;
                    
                    
                }
                return response()->json(['status' => 'success'], 200);
            }else{
                
                return response()->json(['status' => 'fail'], 200);
            }
        }

        function checkTodayLearn(){
            $id = Auth::id(); 
            $break = curve::where('UserId','=', $id)->latest()->first();
            $day =date("Y-m-d");
            if($break['date'] != $day){
                return response()->json(['status' => 'need to lean today course', 'result' => false], 200); 
            }else{
                return response()->json(['status' => 'success', 'result' => true], 200);
            }

        }

        public function getTraditionReviewDataBackup(){

            $id = Auth::id(); 
            if($id == null){
                return response()->json(['status' => 'fail'], 200);
            }
            $time = [1, 2, 3, 4];
    
            $group = tra::where('UserId','=', $id)->where('time','=', 0)->get();
            
            $les = [];
            $les['day'] = [];
            $les['id'] = [];
            $les['Word'] = [];
            $les['time'] = [];
            $ENo = [];
            $result = [];
            foreach($group as $item){
                $end = $item->date;
                $start = date("Y-m-d");
    
                $datetime_start = new DateTime($start);
                $datetime_end = new DateTime($end);
                $days = $datetime_start->diff($datetime_end)->days;
                
                if(in_array($days, $time)){
                    $les['day'] = $days;
                    $les['id'] = $item->GId;
                    $les['time'] = $item->time;
                    
                    //base on accuracy order
                    // $tmp = curveDetail::where('GId','=', $item->GId)->where('time','=', 0)->get()->toArray();
                    // $num = $this->reviewWord($tmp, $days);
                    // array_multisort(array_column($tmp,'accuracy'),SORT_ASC,$tmp);
                    //base on accuracy, sort of accuracy rate, if rate less, then priority select
    
                    //base on random order
                    $tmp = traDetail::where('GId','=', $item->GId)->where('time','=', 0)->inRandomOrder()->get()->toArray();
                    $num = $this->reviewWord($tmp, $days);
                    
                    //base on random order
                    
                    
                    // $n = 0;
                    foreach($tmp as $item){
                        // if($n == $num){
                        //     break;
                        // }else{
                            $d = en_word::where('id','=', $item['ENo'])->first();
                            // unset($d->id);
                            unset($d->level);
                            unset($d->created_at);
                            unset($d->updated_at);
                            
                            $ti = traDetail::where('UserId','=', $id)->where('ENo', '=', $d->id)->latest()->first();
                            // return response()->json(['status' => 'success', 'result' => $time], 200);
                            $d->level = $ti->time;
                            
                            // array_push($d, $item['time']);
                            // $n ++;
                            $les['Word'] = $d;
                            array_push($result, $les);
                            
                        // }
                    }
                    $les['day'] = [];
                    $les['id'] = [];
                    $les['Word'] = [];
                    $les['time'] = [];
                    $les = [];
                }
            }
            $result = array_reverse($result);
            return response()->json(['status' => 'success', 'result' => $result], 200);
            
        }
        public function getTraditionReviewData(){
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
                for ($i = 1; $i <= $len; $i++) {
                    array_push($tmpArray, $tmpNum);
                    array_push($list, $tmpNum);
                    $tmpNum ++;
                }
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
        public function getTraditionReviewDataOld(){
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
        // $group = array_reverse($group);
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
            for ($i = 1; $i <= $len; $i++) {
                array_push($tmpArray, $tmpNum);
                $tmpNum ++;
            }
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

     
        // return response()->json(['status' => $tmpData], 200);

        for ($i = 1; $i <= 50; $i++) {
          
            if($i > $countTotalNum){
                break;
            }
            $repeat = true;
            while($repeat){
                
                $num = $this->randWithout(0, $tmpNum, $repeatArray);
                // return response()->json(['select num' => $num], 200);
                // continue;
                foreach($data as $item){
                    
                    if(in_array($num, $item)){
                        
                        $randArr[$item[0]][$item[0]] ++;
                        $repeat = false;
                        if($randArr[$item[0]][$item[0]] == 20){
                            foreach($item as $ddddd){
                                array_push($repeatArray, $ddddd);
                            }
                            
                            //return response()->json(['item' => $repeatArray,'data' => $data,'select num' => $num, 'result2222' => $randArr[$item[0]]], 200);
                        
                            
                        }
                        //return response()->json(['item' => $item,'data' => $data,'select num' => $num, 'result2222' => $randArr[$item[0]][$item[0]] ], 200);
                        break;
                    }
                }

            }
            
            
        }
                        
        // return response()->json([gettype($randArr[0])], 200); 
             
        //return response()->json(['status' => $data, 'randArr' => $randArr, 'repeatArray' => $repeatArray], 200);
        foreach($randArr as $item){ 
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
                $ti = traDetail::where('UserId','=', $id)->where('ENo', '=', $d->id)->latest()->first();
                $d->level = $ti->time;
                $les['Word'] = $d;
                array_push($result, $les);
                $r ++;
                // return response()->json(['status' => $result, 'GId'=>$i->GId, 'time'=>$i->time], 200);

            }     
            
           
        }
        return response()->json(['status' => $data, 'result' => $result, 'r' => $r, 'tmpGId' => $tmpGId], 200);

            // $id = Auth::id(); 
            // if($id == null){
            //     return response()->json(['status' => 'fail'], 200);
            // }
    
            // $group = curve::where('UserId','=', $id)->where('time','=', 0)->get();
            
            // $len = count($group);
            // $data = [];
            // $tmpNum = 0;
            // foreach($group as $item){
            //     $tmpArray = [];
            //     for ($i = 1; $i <= $len; $i++) {
            //         array_push($tmpArray, $tmpNum);
            //         $tmpNum ++;
            //     }
            //     $data[$item->GId] = $tmpArray;
            //     $len --;
            // }
    
            // $les = [];
            // $les['day'] = [];
            // $les['id'] = [];
            // $les['Word'] = [];
            // $les['time'] = [];
            // $ENo = [];
            // $result = [];
            
            // $tmpGId = [];
            // $tmpNum--;
            // $r = 0;
                        
            // for ($i = 1; $i <= 50; $i++) {
            //     if($i > $tmpNum){
            //         break;
            //     }
            //     $num = random_int(0, $tmpNum);
    
            //     foreach($data as $item){
            //         if(in_array($num, $item)){
            //             // return response()->json(['status' => array_keys($data, $item),'statuss' => $item,'statusss' => $data], 200);
                        
            //             $reply = -1;
            //             while($reply){
            //                 $tmpEn = curveDetail::where('GId','=', array_keys($data, $item))->where('time','=', 0)->inRandomOrder()->limit(1)->get();
                            
            //                 // return response()->json(['status' => $tmpEn[0]->GId, $tmpGId], 200);
    
            //                 if(in_array($tmpEn[0]->ENo, $tmpGId)){
                                
            //                     // $reply ++;
                                
            //                 }else{
            //                     $les = [];
            //                     // $les['day'] = [];
            //                     $les['id'] = [];
            //                     $les['Word'] = [];
            //                     $les['time'] = [];
            //                     // $les['day'] = $days;
            //                     $les['id'] = $tmpEn[0]->GId;
            //                     $les['time'] = $tmpEn[0]->time;
            //                     array_push($tmpGId, $tmpEn[0]->ENo);
            //                     $d = en_word::where('id','=', $tmpEn[0]->ENo)->first();
            //                     // return response()->json(['status' => $data, 'statuss' => $tmpGId], 200);
            //                     $ti = curveDetail::where('UserId','=', $id)->where('ENo', '=', $d->id)->latest()->first();
            //                     $d->level = $ti->time;
            //                     $les['Word'] = $d;
            //                     array_push($result, $les);
            //                     $reply ++;
            //                     $r ++;
    
            //                 }
            //                 // $reply ++;
            //             }
                        
            //             break;
    
                        
            //         }
            //     }
                
    
                
            // }
            // return response()->json(['status' => $data, 'result' => $result, 'r' => $r, 'tmpGId' => $tmpGId], 200);
      
            
        }

        function updateTraGroupInfo(Request $request){
            // return response()->json(['status' => 'success', 'LessonDetail' => $request->LessonDetail, 'LessonData' => $request->LessonData], 200); 
            
            if(isset($request) && $request != null){

                $id = Auth::id(); 
                foreach($request->LessonData as $item){
                    
                    // $break = curve::where('GId','=', $item['GId'])->latest()->first();
                    // if($break){
                    //     return response()->json(['status' => 'success', 'LessonDetail' => $request->LessonDetail, 'LessonData' => $request->LessonData], 200); 
            
                    // }
                    $cu = new tra();
                    $cu->GId = $item['GId'];
                    $ti = tra::where('GId','=', $item['GId'])->latest()->first();
                    // $cu->time = $item['time']+1;
                    $cu->time = $ti->time+1;
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
                    $dr = new traDetail();
                    
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
                    
                    $totalRate = 0;
                    
                    
                }
                return response()->json(['status' => 'success'], 200);
            }else{
                
                return response()->json(['status' => 'fail'], 200);
            }
        }
        
    
}

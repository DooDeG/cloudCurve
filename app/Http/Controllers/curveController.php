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
        $les['Word'] = [];
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

                $tmp = curveDetail::where('GId','=', $item->GId)->get()->toArray();
                $num = $this->reviewWord($tmp, $days);
                
                
                array_multisort(array_column($tmp,'accuracy'),SORT_ASC,$tmp);
                
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
                        array_push($ENo, $d);
                        $n ++;
                    }
                }
                $les['Word'] = $ENo;
                
                array_push($result, $les);
                $les['day'] = [];
                $les['id'] = [];
                $les['Word'] = [];
                $les = [];
                $ENo = [];
            }
        }
        $result = array_reverse($result);
        return response()->json(['status' => 'success', 'result' => $result], 200);
        
        
        
    }

    public function getTodayReviewData(){

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
                    $cu->time = $item['time']+1;
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
    
}

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
            // return response()->json(['status' => $days], 200);
            
            if(in_array($days, $time)){
                $les['day'] = $days;
                $les['id'] = $item->GId;

                $tmp = curveDetail::where('GId','=', $item->GId)->get()->toArray();
                $num = $this->reviewWord($tmp, $days);
                //condition

                //select word from en_word
                // foreach($tmp as $item){
                //     if($num == 20){
                //         $d = en_word::where('id','=', $item->ENo)->first();
                //     }else{
                //         break;
                //     }
                //     unset($d->id);
                //     unset($d->level);
                //     unset($d->created_at);
                //     unset($d->updated_at);
                //     array_push($ENo, $d);
                // }
                
                // sort($tmp->accuracy);
                // array_multisort(array_column($tmp,'accuracy'),SORT_ASC,$tmp);
                // $tmp = $this->array_sort($tmp,'ENo','desc');
                // $d = array_column($tmp, 'sort');
                // array_multisort($d, SORT_ASC, $tmp);
                
                array_multisort(array_column($tmp,'accuracy'),SORT_ASC,$tmp);
                // return response()->json(['status' => 'success', 'result' => $tmp], 200);
                
                $n = 0;
                // return response()->json(['status' => 'success', 'result' => $item['ENo']], 200);
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
    
}

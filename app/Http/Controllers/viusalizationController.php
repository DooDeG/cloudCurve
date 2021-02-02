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
}

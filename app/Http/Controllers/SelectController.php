<?php

namespace App\Http\Controllers;

use App\Models\ValueCandle;
use Illuminate\Http\Request;
use App\Models\Currency;


class SelectController extends Controller
{
    public static function currencyAndValue(Request $request){
       $allCurrency =  Currency::selectAll();
       $defaultValues = ValueCandle::getValueCandle("ETHUSDT", "one");
       echo json_encode([$allCurrency, $defaultValues]);
    }

    public function showCandle(Request $request){
        $showValues = ValueCandle::getValueCandle($request->name, $request->item);
        echo json_encode($showValues);
    }
}

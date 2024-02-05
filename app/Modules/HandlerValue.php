<?php

namespace Modules;

use App\Http\Controllers\SelectController;
use App\Models\Currency;
use App\Models\ValueCandle;


class HandlerValue{

    public static function allCurrency(){
        $currency = SelectController::currencyAndValue();
        return $currency;
    }

    public static function getValueToMinutes($name, $howMinute, $chart = null){
        $currency = Currency::select("id","name")->where("name",$name)->orderBy("id","DESC")->first();
        if($chart == null) {
            $getValue = ValueCandle::getValueCandle($currency->id, $howMinute);
            return $getValue;
        }
    }
}

$result = json_decode(file_get_contents("php://input"),1);

if(isset($result) && $result !== ""){
    echo json_encode($result['name']);
    $getValue = HandlerValue::getValueToMinutes($result['name'],$result['item'], $result['chart']);
    echo json_encode($getValue);
}else{
    $getAllCurrency = HandlerValue::allCurrency();
    echo json_encode($getAllCurrency);
}



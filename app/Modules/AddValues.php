<?php

namespace Modules;

use App\Models\ValueCandle;

class AddValues{

    public static function getNewValue($val,$values){
        if($val){
            $values = (Float)$values;
            $val->min = ($val->min > $values)?$values:$val->min;
            $val->max = ($val->max < $values)?$values:$val->max;
            $val->close = $values;
            $val->save();
        }
    }

    public static function addValueOne($id, $values)
    {
        $newValues = ValueCandle::where([['currency_id', $id],['status','one']])->orderBy('id', 'DESC')->first();
        AddValues::getNewValue($newValues,$values);
    }
    public static function addValueFive($id, $values)
    {
        $newValues = ValueCandle::where([['currency_id', $id],['status','five']])->orderBy('id', 'DESC')->first();
        AddValues::getNewValue($newValues,$values);
    }
    public static function addValueTen($id, $values)
    {
        $newValues = ValueCandle::where([['currency_id', $id],['status','ten']])->orderBy('id', 'DESC')->first();
        AddValues::getNewValue($newValues,$values);
    }
    public static function addValueFifteen($id, $values)
    {
        $newValues = ValueCandle::where([['currency_id', $id],['status','fifteen']])->orderBy('id', 'DESC')->first();
        AddValues::getNewValue($newValues,$values);
    }

    public static function addValueThirty($id, $values)
    {
        $newValues = ValueCandle::where([['currency_id', $id],['status','thirty']])->orderBy('id', 'DESC')->first();
        AddValues::getNewValue($newValues,$values);
    }
}

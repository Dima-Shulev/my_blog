<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Currency;

class ValueCandle extends Model
{
    use HasFactory;
    protected $table = "value_candles";
    protected $fillable = ["open", "min", "max", "close", "status", "created_at", "currency_id"];
    public $timestamps = false;
    protected $casts = ["created_at" =>"datetime: Y-m-d H:i:s+00:00"];

    public function currency(){
        return $this->belongsTo("App/Models/Currency");
    }


    public function createCandle($how)
    {
        $cur = new Currency();
        $res = $cur->select('id')->orderBy('id', "ASC")->get();
        if ($res !== null) {
            foreach ($res as $item) {
                $lastVal = ValueCandle::where([['currency_id', $item->id],['status', $how]])->orderBy('id', 'DESC')->first();
                $val = ($lastVal) ? $lastVal->close : 0;

                ValueCandle::create([
                    'currency_id' => $item->id,
                    'open' => (Float)$val,
                    'min' => (Float)$val,
                    'max' => (Float)$val,
                    'close' => (Float)$val,
                    'status' => $how,
                    'created_at' => Date('Y-m-d H:i:00')
                ]);
            }
        }
    }

    public function selectToDb($id, $how){
        $values = ValueCandle::select("open", "min", "max", "close", "status", "created_at", "currency_id")
            ->where([["currency_id", (int)$id],["status", "$how"]])
            ->orderBy("created_at", "DESC")
            ->take(10)
            ->get()
            ->toArray();

        if (count($values) > 0) {
            return array_reverse($values);
        }
    }


    public static function getValueCandle($name, $howMinute)  {
        $idCurrency = Currency::select("id","name")->where("name",$name)->orderBy("id","DESC")->first();
        switch ($howMinute) {
            case "def":

                $values = ValueCandle::select("open","min","max","close", "status", "created_at", "currency_id")
                    ->where([["currency_id", (int)$idCurrency->id],["status", "one"]])
                    ->orderBy("created_at", "DESC")
                    ->take(10)
                    ->get()
                    ->toArray();

                if (count($values) > 0) {
                    return array_reverse($values);
                }
                break;

            case "one":
                     $valuesFiveMinute = ValueCandle::select("open", "min", "max", "close", "status", "created_at", "currency_id")
                    ->where([["currency_id", $idCurrency->id],["status", "one"]])
                    ->orderBy("created_at", "DESC")
                    ->take(10)
                    ->get()
                    ->toArray();
                if (count($valuesFiveMinute) > 0) {
                    return array_reverse($valuesFiveMinute);
                }
                break;

            case "five":

                $valuesFiveMinute = ValueCandle::select("open", "min", "max", "close", "status", "created_at", "currency_id")
                    ->where([["currency_id", (int)$idCurrency->id], ["status", "five"]])
                    ->orderBy("created_at", "DESC")
                    ->take(10)
                    ->get()
                    ->toArray();
                if (count($valuesFiveMinute) > 0) {
                    return array_reverse($valuesFiveMinute);
                }
                break;

            case "ten":
                $valuesTenMinute = ValueCandle::select("open","min","max","close", "status", "created_at", "currency_id")
                    ->where([["currency_id", (int)$idCurrency->id], ["status", "ten"]])
                    ->orderBy("id", "DESC")
                    ->take(10)
                    ->get()
                    ->toArray();
                if (count($valuesTenMinute) > 0) {
                    return array_reverse($valuesTenMinute);
                }
                break;

            case "fifteen":
                $valuesFifteenMinute = ValueCandle::select("open", "min", "max", "close", "status", "created_at", "currency_id")
                    ->where([["currency_id", (int)$idCurrency->id], ["status", "fifteen"]])
                    ->orderBy("id", "DESC")
                    ->take(10)
                    ->get()
                    ->toArray();
                if (count($valuesFifteenMinute) > 0) {
                    return array_reverse($valuesFifteenMinute);
                }
                break;

            case "thirty":
                $valuesThirtyMinute = ValueCandle::select("open", "min", "max", "close", "status", "created_at", "currency_id")
                    ->where([["currency_id", (int)$idCurrency->id], ["status", "thirty"]])
                    ->orderBy("id", "DESC")
                    ->take(10)
                    ->get()
                    ->toArray();
                if (count($valuesThirtyMinute) > 0) {
                    return array_reverse($valuesThirtyMinute);
                }
                break;

            default:
                $valuesDefMinute = ValueCandle::select("open", "min", "max", "close", "status", "created_at", "currency_id")
                    ->where([["currency_id", (int)"1342"],["status", "one"]])
                    ->orderBy("created_at", "DESC")
                    ->take(10)
                    ->get()
                    ->toArray();
                if (count($valuesDefMinute) > 0) {
                    return array_reverse($valuesDefMinute);
                }
        }
    }

   /* public function chunkDelete($middle,$how){
        ValueCandle::where('status',$how)->orderBy('id','ASC')->limit($middle)->chunk(1000, function ($values) {
            foreach ($values as $value) {

                dd($value);
               $value->delete();
            }
        });
    }*/

    public function deleteCandle($howMinute){
        switch($howMinute){
            case 'one':
                $count = ValueCandle::where('status','one')->count();
                $count = floor($count);
                $middle = $count/2;
                /*$this->chunkDelete($middle,'one');*/
                $deleteHalf = ValueCandle::where('status','one')->orderBy('id','ASC')->limit($middle)->delete();
                break;
            case 'five':
                $count = ValueCandle::where('status','five')->count();
                $count = floor($count);
                $middle = $count/2;
                $deleteHalf = ValueCandle::where('status','five')->orderBy('id','ASC')->limit($middle)->delete();
                break;
            case 'ten':
                $count = ValueCandle::where('status','ten')->count();
                $count = floor($count);
                $middle = $count/2;
                $deleteHalf = ValueCandle::where('status','ten')->orderBy('id','ASC')->limit($middle)->delete();
                break;
            case 'fifteen':
                $count = ValueCandle::where('status','fifteen')->count();
                $count = floor($count);
                $middle = $count/2;
                $deleteHalf = ValueCandle::where('status','fifteen')->orderBy('id','ASC')->limit($middle)->delete();
                break;
            case 'thirty':
                $count = ValueCandle::where('status','thirty')->count();
                $count = floor($count);
                $middle = $count/2;
                $deleteHalf = ValueCandle::where('status','thirty')->orderBy('id','ASC')->limit($middle)->delete();
                break;
            default:
                echo "Нечего удалять";
        }
        return $deleteHalf;
    }
}

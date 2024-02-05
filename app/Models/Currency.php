<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $table = "currencys";
    protected $fillable = ['name'];
    public $timestamps = false;

    public function valueCandle(){
        return $this->hasMany('App\Models\ValueCandle');
    }

    public static function selectAll(){
        $currencys = Currency::select("id","name")->orderBy("name","ASC")->get();
        return $currencys;
    }
}

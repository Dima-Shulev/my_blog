<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = ['title','content','user_id','created_at','like'];
    public $timestamps = false;
    protected $hidden = ['status'];
    protected $casts = ["created_at" =>"datetime: Y-m-d H:i:s+00:00"];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $fillable = [
        'metaKey',
        'metaDescription',
        'title',
        'content',
        'created_at',
        'active',
        'module_name',
        'url',
        'category_id',
        'user_id'
    ];
    public $timestamps = false;
    protected $casts = ['created_at'=>'datetime:Y-m-d H:i:s+00:00'];

    public function user(){
        return $this->belongsTo("App/Models/User");
    }

    public function category(){
        return $this->belongsTo("App/Models/Category");
    }
}

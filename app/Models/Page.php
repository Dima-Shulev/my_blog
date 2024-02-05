<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
        'name',
        'content',
        'metaKey',
        'metaDescription',
        'created_at',
        'url',
        'module_name',
        'active',
        'user_id'
    ];

    public $timestamps = false;
    protected $casts = ['created_at'=>'datetime:Y-m-d H:i:s+00:00'];

    public function user(){
        return $this->belongsTo("App/Models/User");
    }

  /*  public function module(){
        return $this->belongsTo("App/Models/Module");
    }*/
}

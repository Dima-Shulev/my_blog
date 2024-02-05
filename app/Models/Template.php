<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $table = 'templates';
    protected $fillable = [
        'name',
        'active',
        'user_id',
        'style'
    ];
    public $timestamps = false;
    protected $casts = ['style' => 'array'];

    public function module(){
        return $this->hasMany("App/Models/Module");
    }
}

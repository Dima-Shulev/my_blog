<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';
    protected $fillable = [
        'name',
        'position',
        'active',
        'template_id'
    ];
    public $timestamps = false;

    public function template(){
        return $this->belongsTo("App/Models/Template");
    }

}

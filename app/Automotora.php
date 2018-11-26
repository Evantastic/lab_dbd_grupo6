<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Automotora extends Model
{
    protected $table = "automotoras";
    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }    
}

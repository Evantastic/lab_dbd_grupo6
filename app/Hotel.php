<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = "hoteles";
    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }
}

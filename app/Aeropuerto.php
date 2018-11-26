<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeropuerto extends Model
{
    protected $table = "aeropuertos";
    public function aeropuertos(){
        return $this->belongsTo(Ciudad::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    protected $table = "viajes";
    public function ciudad_origen(){
        return $this->belongsTo(Ciudad::class,'ciudad_origen_id');
    }
    public function ciudad_destino(){
        return $this->belongsTo(Ciudad::class,'ciudad_destino_id');
    }
}

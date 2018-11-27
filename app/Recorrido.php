<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recorrido extends Model
{
    protected $table = "recorridos";
    public function vuelos(){
        return $this->belongsToMany(Vuelo::class);
    }
}

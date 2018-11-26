<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = "vehiculos";
    public function automotora(){
        return $this->belongsTo(Automotora::class);
    }        
}

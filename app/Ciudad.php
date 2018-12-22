<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = "ciudades";

    protected $fillable = [
        'nombre',
        'nombre_pais'
    ];
    
    public function hoteles(){
        return $this->hasMany(Hotel::class);
    }

    public function aeropuertos(){
        return $this->hasMany(Aeropuerto::class);
    }

    public function automotoras(){
        return $this->hasMany(Automora::class);
    }
}

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
    
    /**
     * Retorna los hoteles que pertenecen a la ciudad
     */    
    public function hoteles(){
        return $this->hasMany(Hotel::class);
    }
    /**
     * Retorna los aeropuertos que pertenecen a la ciudad
     */
    public function aeropuertos(){
        return $this->hasMany(Aeropuerto::class);
    }
    /**
     * Retorna las automotoras que pertenecen a la ciudad
     */
    public function automotoras(){
        return $this->hasMany(Automora::class);
    }
}

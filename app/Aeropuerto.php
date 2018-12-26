<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ciudad;
use App\Vuelo;

class Aeropuerto extends Model
{
    protected $table = 'aeropuertos';

    protected $fillable = [
        'ciudad_id',
        'direccion',
        'nombre'
    ];
    
    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }

    public function vuelos_llegada(){
        return $this->hasMany(Vuelo::class,'aeropuerto_destino_id');
    }

    public function vuelos_salida(){
        return $this->hasMany(Vuelo::class,'aeropuerto_origen_id');
    }
}

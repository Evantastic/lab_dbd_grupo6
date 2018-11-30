<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = "habitaciones";

    protected $fillable = [
        'hotel_id',
        'numbero_habitacion',
        'capacidad',
        'descripcion',
        'precio'
    ];
    
    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }
    
    public function paquetes(){
        return $this->hasMany(Paquete::class);
    }

    public function reservas(){
        return $this->belongsToMany(Reserva::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Habitacion_Reserva;

class Habitacion extends Model
{
    protected $table = "habitaciones";

    protected $fillable = [
        'hotel_id',
        'numero_habitacion',
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

    public function habitacion_reservas(){
        return $this->hasMany(Habitacion_Reserva::class);
    }
}

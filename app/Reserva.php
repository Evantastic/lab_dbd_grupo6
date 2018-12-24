<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reserva_Vehiculo;
use App\Recorrido_Reserva;
use App\Habitacion_Reserva;
use App\Paquete_Reserva;
use App\Pasaje;
use App\Compra;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $fillable = [
        'costo',
        'seguro'
    ];

    public function reserva_vehiculos(){
        return $this->hasMany(Reserva_Vehiculo::class);
    }

    public function recorrido_reservas(){
        return $this->hasMany(Recorrido_Reserva::class);
    }

    public function habitacion_reservas(){
        return $this->hasMany(Habitacion_Reserva::class);
    }

    public function paquete_reservas(){
        return $this->hasMany(Paquete_Reserva::class);
    }

    public function pasajes(){
        return $this->hasMany(Pasaje::class);
    }

    public function compras(){
        return $this->hasMany(Compra::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Habitacion;
use App\Reserva;

class Habitacion_Reserva extends Model
{
    protected $table = 'habitacion_reservas';

    protected $fillable = [
        'habitacion_id',
        'reserva_id',
        'precio'
    ];

    protected $dates = [
        'fecha_inicio',
        'fecha_termino'
    ];

    public function habitacion(){
        return $this->belongsTo(Habitacion::class);
    }

    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }
}

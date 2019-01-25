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
        'precio',
        'fecha_inicio',
        'fecha_termino'
    ];

    protected $dates = [
    ];

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }

    public function habitacion(){
        return $this->belongsTo(Habitacion::class);
    }

    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }
}

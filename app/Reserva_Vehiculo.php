<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vehiculo;
use App\Reserva;

class Reserva_Vehiculo extends Model
{
    protected $table = 'reserva_vehiculos';

    protected $fillable  = [
        'vehiculo_id',
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

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }

    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }
}

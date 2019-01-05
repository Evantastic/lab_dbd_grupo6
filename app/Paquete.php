<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = 'paquetes';

    protected $dates = [
        'fecha_expiracion'
    ];

    protected $fillable = [
        'recorrido_id',
        'habitacion_id',
        'vehiculo_id',
        'descuento',
        'tipo',
        'cantidad_personas',
        'fecha_expiracion'
    ];

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }
    
    public function recorrido(){
        return $this->belongsTo(Recorrido::class);
    }
    
    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }

    public function habitacion(){
        return $this->belongsTo(Habitacion::class);
    }

    public function paquete_reservas(){
        return $this->hasMany(Paquete_Reserva::class);
    }
}

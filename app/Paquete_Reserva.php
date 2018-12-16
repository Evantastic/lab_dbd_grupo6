<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paquete;
use App\Reserva;

class Paquete_Reserva extends Model
{
    protected $table = 'paquete_reservas';

    protected $fillable = [
        'paquete_id',
        'reserva_id',
        'descuento'
    ];

    public function paquete(){
        return $this->belongsTo(Paquete::class);
    }

    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recorrido;
use App\Reserva;

class Recorrido_Reserva extends Model
{
    protected $table = 'recorrido_reservas';

    protected $fillable = [
        'recorrido_id',
        'reserva_id',
        'costo_economico',
        'costo_bussiness'
    ];

    public function recorrido(){
        return $this->belongsTo(Recorrido::class);
    }

    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }
}

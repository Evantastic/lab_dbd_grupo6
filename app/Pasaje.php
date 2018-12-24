<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vuelo;
use App\Reserva;
class Pasaje extends Model
{
    protected $table = 'pasajes';
     protected $fillable = [
        'fila',
        'columna',
        'pasaje_simple',
        'asiento_bussiness',
        'asiento_discapacidad'
       
    ];//


    public function vuelo(){
        return $this->belongsTo(Vuelo::class);
    }
    //relacion con reserva

    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }

}

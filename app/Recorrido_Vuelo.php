<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recorrido;
use App\Vuelo;

class Recorrido_Vuelo extends Model
{
    protected $table = 'recorrido_vuelos';

    protected $fillable = [
        'recorrido_id',
        'vuelo_id'
    ];

    public function recorrido(){
        return $this->belongsTo(Recorrido::class);
    }

    public function vuelo(){
        return $this->belongsTo(Vuelo::class);
    }
}

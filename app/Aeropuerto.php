<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeropuerto extends Model
{
    protected $table = 'aeropuertos';

    protected $fillable = [
        'ciudad_id',
        'direccion',
        'nombre'
    ];
    
    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }
}

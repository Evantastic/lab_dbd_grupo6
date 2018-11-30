<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Automotora extends Model
{
    protected $table = 'automotoras';

    protected $fillable = [
        'ciudad_id',
        'direccion',
        'nombre'
    ];
    
    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }
    
    public function vehiculos(){
        return $this->hasMany(Vehiculo::class);
    }
}

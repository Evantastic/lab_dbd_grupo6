<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hoteles';

    protected $fillable = [
        'ciudad_id',
        'nombre',
        'direccion',
        'estrellas',
        'descripcion'
        
    ];
    
    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }
    
    public function habitaciones(){
        return $this->hasMany(Habitacion::class);
    }
}

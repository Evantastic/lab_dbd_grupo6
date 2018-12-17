<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reserva;
use App\User;
class Compra extends Model
{
    
    protected $table = 'compras';

    protected $fillable = [
        'reserva_id',
        'cliente_id'
    ];

    protected $dates = [
    	'fecha_compra'
    ];
    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

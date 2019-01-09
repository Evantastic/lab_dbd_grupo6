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
        'user_id',
        'medio_pago'
    ];

    protected $dates = [
    	'fecha_compra'
    ];

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }
    
    public function reserva(){
        return $this->belongsTo(Reserva::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}

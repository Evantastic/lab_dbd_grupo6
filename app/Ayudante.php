<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ayudados;

class Ayudante extends Model
{
    protected $table = 'ayudantes';

    protected $fillable = [
        'nombre',
        'ramo'
    ];

    public function ayudados(){
        return $this->hasMany(Ayudados::class);
    }
}

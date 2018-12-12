<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ayudados extends Model
{
    protected $table = 'ayudados';

    protected $fillable = [
        'nombre',
        'ayudante_id'
    ];

    public function ayudante(){
        return $this->belongsTo(Ayudante::class);
    }
}

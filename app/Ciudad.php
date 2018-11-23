<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = "ciudades";
    public function hoteles(){
        return $this->hasMany(Hotel::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class queryLog extends Model
{
  
    protected $table = 'queryLogs';

    protected $fillable = [
        'query',
        'user_id'

    ];

    protected $dates = [
    	'fecha_consulta'
    ];

      public function user(){
        return $this->hasMany(User::class);
    }  //
}

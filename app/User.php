<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Compra;
use App\queryLog;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'apellido',
        'nacionalidad',
        'edad',
        'tipoUsuario',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function compras(){
        return $this->hasMany(Compra::class);
    }
    
    public function queryLogs(){
        return $this->hasMany(queryLog::class);
    }

    public function isAdmin(){

        return $this->is_admin;   
    }
}

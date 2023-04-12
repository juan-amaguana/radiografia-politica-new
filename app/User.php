<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function perfil()
    {
        return $this->hasOne('App\Models\Perfil');
    }

    public function partidoPolitico(){
            return $this->hasMany( 'App\Models\partidoPolitico' ); 
    }

    public function patrimonio(){
            return $this->hasMany( 'App\Models\Patrimonio' ); 
    }

     public function persona()
    {
        return $this->hasOne('App\Models\Persona');
    }

    public function campania(){
        return $this->hasMany('App\Models\Campania');
    }

    public function sri(){
        return $this->hasMany('App\Models\Sri');
    }

}

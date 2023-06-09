<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'id';
    
    public function user(){
    	return $this->hasMany('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    //

    protected $fillable = [  
		'nom_direction'
    ];
    public function services(){
        return $this->hasMany(Service::class);  
    }
    
    public function agents(){
        return $this->hasMany(Agent::class);  
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    //

    protected $fillable = [  
		'prenom','nom','fonction','date_naiss','tel', 'whatshap','email','niveau_hieracie','service','service_id','superieur_id','user_id','photo'
    ];

    public function actions(){
        return $this->hasMany(Action::class);  
    }
    
    public function modeles(){
        return $this->hasMany(Modele::class);  
    }

    public function decissions(){
        return $this->hasMany(Decission::class);  
    }

    public function formations(){
        return $this->hasMany(Formation::class);  
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
    
    public function direction(){
        return $this->belongsTo(Direction::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function modules(){
        return $this->belongsToMany(Module::class);
    }
}

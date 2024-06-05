<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    //
     protected $fillable = [  
		'libelle','deadline','visibilite','note','risque', 'delais','reunion','agent','agent_id','reunion_id','responsable','bakup','raison','action_respon'
    ];

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function reunion(){
        return $this->belongsTo(Reunion::class);
    }

    public function suivi_actions(){
        return $this->hasMany(Suivi_action::class);  
    }
}

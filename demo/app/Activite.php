<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    //

    protected $fillable = [  
		'libelle','res_dir','nbr_jour','deadline','pourcentage', 'strategique_id'
    ];

    public function strategique(){
        return $this->belongsTo(Strategique::class);
    }
    
    public function taches(){
        return $this->hasMany(Tache::class);  
    }
    
    public function modeles(){
        return $this->hasMany(Modele::class);  
    }
}

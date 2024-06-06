<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class statutOpportunite extends Model
{
    
    protected $table = "statut_opportunites";
    
    protected $fillable = ['libelle'];
}

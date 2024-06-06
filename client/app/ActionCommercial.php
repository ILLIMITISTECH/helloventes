<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionCommercial extends Model
{
    
    protected $table = "action_commerciales";
    
    protected $fillable = [
        'libelle','commercial_id','opportunite_id','prospect_id','priorite','deadline','cloture	'
    ];
}

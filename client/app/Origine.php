<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Origine extends Model
{
    
    protected $table = "origines";
    
    protected $fillable = ['libelle'];
}

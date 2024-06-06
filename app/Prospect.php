<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    public function opportunites()
    {
        return $this->hasMany(Opportunite::class);
    }
}
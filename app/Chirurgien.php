<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chirurgien extends Model
{
    //
    
    public function specialites()
    {
        return $this->belongsToMany('App\Specialite')->withTimestamps();
    }
}

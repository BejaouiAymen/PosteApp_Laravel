<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    public function chirurgiens()
    {
        return $this->belongsToMany('App\Chirurgien')->withTimestamps();
    }
}

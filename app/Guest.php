<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public function eventlog()
    {
    	return $this->hasMany(Eventlog::class);
    }
}

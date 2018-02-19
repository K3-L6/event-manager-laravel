<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    public $timestamps = false;

    public function role()
    {
    	return $this->belongsTo(Role::class);
    }
}

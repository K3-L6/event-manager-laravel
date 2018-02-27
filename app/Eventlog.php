<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventlog extends Model
{
    public $timestamps = false;

    public function guest()
    {
    	return $this->belongsTo(Guest::class);
    }
}

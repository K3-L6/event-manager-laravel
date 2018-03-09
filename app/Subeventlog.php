<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subeventlog extends Model
{
    public $timestamps = false;

    public function guest()
    {
    	return $this->belongsTo(Guest::class);
    }

    public function subevent()
    {
    	return $this->belongsTo(Subevent::class);
    }
}

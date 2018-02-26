<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subevent;

class SubeventController extends Controller
{
    public function entrance($id)
    {
    	// return "test";
    	$subevent = Subevent::find($id);
    	return view('subevent_entrance')->withSubevent($subevent);
    }
}

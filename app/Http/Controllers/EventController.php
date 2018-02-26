<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function entrance()
    {
    	$event = Event::first();
    	return view('event_entrance')->withEvent($event);
    }

    public function exit()
    {
        $event = Event::first();
        return view('event_exit')->withEvent($event);
    }

}

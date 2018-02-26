<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Guest;
use App\Event;
use App\Eventlog;

class EventController extends Controller
{
    public function entrance()
    {
    	$event = Event::first();
    	return view('event_entrance')->withEvent($event);
    }

    public function log(Request $request)
    {
        $guest = Guest::where('idcard', $request->idcard)->first();
        
        $eventlog = new Eventlog;
        $eventlog->guest_id = $guest->id;
        $eventlog->time = Carbon::now();
        $eventlog->save();
        return redirect()->back();
    }

    public function exit()
    {
        $event = Event::first();
        return view('event_exit')->withEvent($event);
    }

}

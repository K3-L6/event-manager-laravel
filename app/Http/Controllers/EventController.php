<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Guest;
use App\Event;
use App\Eventlog;
use App\User;
use App\Audit;

use Auth;
use Flashy;

class EventController extends Controller
{
    public function entrance()
    {
    	$event = Event::first();

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'started attendance logging for the ' . $event->title . ' event';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

    	return view('event_entrance')->withEvent($event);
    }

    public function exit()
    {
        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'ended attendance logging for the ' . $event->title . ' event';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();
        return redirect()->to('/home');
    }

    public function log(Request $request)
    {
        try{
            $guest = Guest::where('idcard', str_replace('Enter', '', $request->idcard))->first();    

            $existingeventlogs = Eventlog::all();
            $exist = false;
            foreach ($existingeventlogs as $log) {
                if ($log->guest_id == $guest->id) {
                    $exist = true;
                }
            }
            if (!$exist) {
                $eventlog = new Eventlog;
                $eventlog->guest_id = $guest->id;
                $eventlog->time = Carbon::now();
                $eventlog->save();    
            }

            $eventlog = Eventlog::where('guest_id', $guest->id)->first();
            $eventlog->guest_id = $guest->id;
            $eventlog->time = Carbon::now();
            $eventlog->save();


            Flashy::info('welcome ' . ucwords($guest->firstname) . ' ' . ucwords($guest->middlename) . ' ' . ucwords($guest->lastname), '#');
            return redirect()->back();
        }
        catch(\Exception $e){
            Flashy::error('User Not Found');
            return redirect()->back();
        }
        
        
        
    }

}

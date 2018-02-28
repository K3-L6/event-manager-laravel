<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Guest;
use App\Subevent;
use App\Subeventlog;
use Flashy;

class SubeventController extends Controller
{
    public function entrance($id)
    {
    	$subevent = Subevent::find($id);
    	return view('subevent_entrance')->withSubevent($subevent);
    }

    public function log(Request $request)
    {
    	$guest = Guest::where('idcard', str_replace('Enter', '', $request->idcard))->first();
    	
        $existinglogs = Subeventlog::all();
        $exist = false;
        foreach ($existinglogs as $log) {
            if ($log->guest_id == $guest->id) {
                $exist = true;
            }
        }
        if (!$exist) {
            $subeventlog = new Subeventlog;
            $subeventlog->guest_id = $guest->id;
            $subeventlog->subevent_id = $request->subeventid;
            $subeventlog->time = Carbon::now();
            $subeventlog->save(); 
        }

        $subeventlog = Subeventlog::where('guest_id', $guest->id)->first();
        $subeventlog->guest_id = $guest->id;
        $subeventlog->subevent_id = $request->subeventid;
        $subeventlog->time = Carbon::now();
        $subeventlog->save();

    	
        Flashy::info('welcome ' . ucwords($guest->firstname) . ' ' . ucwords($guest->middlename) . ' ' . ucwords($guest->lastname), '#');
    	return redirect()->back();
    }
}

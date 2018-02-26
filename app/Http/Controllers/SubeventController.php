<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Guest;
use App\Subevent;
use App\Subeventlog;

class SubeventController extends Controller
{
    public function entrance($id)
    {
    	$subevent = Subevent::find($id);
    	return view('subevent_entrance')->withSubevent($subevent);
    }

    public function log(Request $request)
    {
    	$guest = Guest::where('idcard', $request->idcard)->first();
    	
    	$subeventlog = new Subeventlog;
    	$subeventlog->guest_id = $guest->id;
    	$subeventlog->subevent_id = $request->subeventid;
    	$subeventlog->time = Carbon::now();
    	$subeventlog->save();
    	return redirect()->back();
    }
}

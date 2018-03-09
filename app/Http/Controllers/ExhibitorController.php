<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Flashy;

use App\Subevent;
use App\Subeventlog;
use App\Guest;

class ExhibitorController extends Controller
{
    public function index()
    {
    	$subevent = Subevent::where('user_id', Auth::user()->id)->get();
    	//hot fix cant access object in a foreach twice so i pass it twice here
    	$subevents = Subevent::where('user_id', Auth::user()->id)->get();
    	return view('exhibitor')->withSubevent($subevent)->withSubevents($subevents);
    }

    public function guestlogslist(Request $request, $id)
    {
    	$subevent = Subevent::find($id);
    	$subeventlog = Subeventlog::where('subevent_id', $id)->get();
    	return view('guestlogs_list')->withSubevent($subevent)->withSubeventlog($subeventlog);
    }

    public function manuallog(Request $request, $id)
    {
    	$subevent = Subevent::find($id);
    	
    	try{
    		$guest = Guest::where('idcard', $request->idcard)->first();

    	    $existingsubeventlogs = Subeventlog::where('subevent_id', $id)->get();
    	    $exist = false;
    	    foreach ($existingsubeventlogs as $log) {
    	        if ($log->guest_id == $guest->id) {
    	            $exist = true;
    	        }
    	    }
    	    if (!$exist) {
    	        $subeventlog = new Subeventlog;
    	        $subeventlog->guest_id = $guest->id;
    	        $subeventlog->subevent_id = $id;
    	        $subeventlog->time = Carbon::now();
    	        $subeventlog->save(); 

    	        return redirect()->back()->with('success', 'Successfully Logged ' . ucwords($guest->firstname) . ' ' . ucwords($guest->middlename) . ' ' . ucwords($guest->lastname));
    	    }else{
    	        return redirect()->back()->with('error', 'Guest Is Already Logged');
    	    }
    	}
    	catch(\Exception $e){
    	    return redirect()->back()->with('error', 'Guest Not Found');
    	}
    }
}

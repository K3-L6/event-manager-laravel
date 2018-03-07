<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Guest;
use App\Subevent;
use App\Subeventlog;
use App\User;
use App\Audit;

use Auth;
use Flashy;

class SubeventController extends Controller
{
    public function entrance($id)
    {
    	$subevent = Subevent::find($id);

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'started logging for the ' . $subevent->title . ' subevent';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();

    	return view('subevent_entrance')->withSubevent($subevent);
    }

    public function exit($id)
    {
        $subevent = Subevent::find($id);

        $user = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'ended logging for the ' . $subevent->title . ' subevent';
        $audit->user_id = $user->id;
        $audit->time = Carbon::now();
        $audit->save();
        return redirect()->to('/home');
    }

    public function log(Request $request)
    {
        try{
            $guest = Guest::where('idcard', str_replace('Enter', '', $request->idcard))->first();
            
            $subeventlog = new Subeventlog;
            $subeventlog->guest_id = $guest->id;
            $subeventlog->subevent_id = $request->subeventid;
            $subeventlog->time = Carbon::now();
            $subeventlog->save(); 

            Flashy::info('welcome ' . ucwords($guest->firstname) . ' ' . ucwords($guest->middlename) . ' ' . ucwords($guest->lastname), '#');
            return redirect()->back();
        }
        catch(\Exception $e){
            Flashy::error('User Not Found', '#');
            return redirect()->back();
        }
    	
    }
}

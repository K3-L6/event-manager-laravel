<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Subevent;

class ExhibitorController extends Controller
{
    public function index()
    {
    	$subevent = Subevent::where('user_id', Auth::user()->id)->get();
    	return view('exhibitor')->withSubevent($subevent);
    }
}

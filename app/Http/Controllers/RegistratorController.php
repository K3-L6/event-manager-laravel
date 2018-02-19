<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistratorController extends Controller
{
    public function index()
    {
    	return view('registrator');
    }
}

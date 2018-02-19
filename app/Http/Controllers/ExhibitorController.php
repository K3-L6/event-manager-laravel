<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExhibitorController extends Controller
{
    public function index()
    {
    	return view('exhibitor');
    }
}

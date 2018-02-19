<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('role.access')->find(Auth::user()->id);
        if (count($user->role->access) == 1) {
            foreach ($user->role->access as $access) {
                $module = $access->module;
                switch ($module) {
                    case 'administrator':
                        return view('admin');
                        break;
                    case 'exhibitor':
                        return view('exhibitor');
                        break;
                    case 'registrator':
                        return view('registrator');
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }
        }
        return view('home')->withUser($user);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use App\Audit;
use App\User;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $logger = User::find(Auth::user()->id);
        $audit = new Audit;
        $audit->description = 'logged in';
        $audit->user_id = $logger->id;
        $audit->time = Carbon::now();;
        $audit->save();
        return redirect()->to('/home');
    }

    public function logout(Request $request) 
    {
      $logger = User::find(Auth::user()->id);
      $audit = new Audit;
      $audit->description = 'logged out';
      $audit->user_id = $logger->id;
      $audit->time = Carbon::now();;
      $audit->save();
      Auth::logout();
      return redirect()->to('/');
    }

}

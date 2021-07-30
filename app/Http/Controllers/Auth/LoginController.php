<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Str;
use App\Mail\ClientMessages;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/guichet/create';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$admin=User::get();
		if($admin->isEmpty()){
			$newadmin=new User;
			$newadmin->id=1;
			$newadmin->name='admin';
			$newadmin->email='admin@gmail.com';
			$passwrd=Str::random(15);
			$newadmin->password=$passwrd;
			
			Mail::to($newadmin->email)->send(
			new ClientMessages($newadmin)
		);
			$newadmin->password=bcrypt($passwrd);
			
			$newadmin->save();
		}
        $this->middleware('guest')->except('logout');
    }
}

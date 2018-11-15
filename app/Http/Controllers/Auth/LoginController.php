<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

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

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

  
    public  function login(Request $request)
    {

        $password = md5($request->password);
        $email = $request->email;


        $user = User::where(['email' => $email, 'password' => $password ])->first();

       
        session()->put('username', $user->username);
        if($password == $user['password'] && $email == $user['email']){
            

            session()->put('email', $email);
            session()->put('firstname', $user->firstname);
            session()->put('middlename', $user->middlename);
            session()->put('lastname', $user->lastname);
            


            return redirect()->route('home');


            // return view('home', compact('user'));


        } else {

            session()->flash('error', 'Login Failed');

            return redirect()->back();
        }


    }

   




}

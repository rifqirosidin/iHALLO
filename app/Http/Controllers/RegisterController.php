<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class RegisterController extends Controller
{
    
    public function showRegistrationForm()
    {
        return view ('auth.register');
    }

	public  function store(Request $request)
    
    {
        // dd($request->all());

         User::create([
           
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => md5($request['password']),
            'firstname' => $request['firstname'],
            'middlename' => $request['middle'],
            'lastname' => $request['lastname'],
            'address' => $request['road'],
            'address2' => $request['city'],
            'post_code' => $request['postcode'],
            'phone' => $request['phone'],
            'mobile' => $request['mobile'],
            

        ]);

         return redirect()->back();




    }
}

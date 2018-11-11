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
//        dd($request['postcode']);
        $this->validate($request, [
            'username' => 'required|unique:rm_users|max:10',
            'email' => 'required|email|unique:rm_users',
            'password' => 'required|min:6',
            'firstname' => 'required',
            'phone' => 'required|nullable',
            'mobile' => 'required|min:11|numeric',
        ]);

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

         session()->flash('success', 'User Created Successfuly');

         return redirect()->back();




    }
}

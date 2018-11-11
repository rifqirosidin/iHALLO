<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;
    
     protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:rm_users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
 

      protected function create(array $data)
    
    {
       
         return User::create([
           
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => md5($data['password']),
            'firstname' => $data['firstname'],
            'middlename' => $data['middle'],
            'lastname' => $data['lastname'],
            'address' => $data['road'],
            'address2' => $data['city'],
            'post_code' => $data['postcode'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],

        ]);

    
    }
}

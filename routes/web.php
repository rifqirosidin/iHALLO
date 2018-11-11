<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('auth.login');
});


Route::middleware(['login'])->group(function (){

    Route::get('/home', 'Auth\LoginController@home')->name('home');
});
//Route::get('/home', 'Auth\LoginController@home')->name('home');

 Route::get('/create/user', 'RegisterController@showRegistrationForm')->name('user.register')->middleware('AuthRegister');
 Route::post('/register/user', 'RegisterController@store')->name('store.register');


Auth::routes();





use App\User;

View::composer('*', function ($view) {

    $firstname = Session::get('firstname');
    $middlename = Session::get('middlename');
    $lastname = Session::get('lastname');

    $fullname = $firstname . ' ' . $middlename . ' ' . $lastname;
//    $username = ucfirst($f);
    $view->with('user', $fullname);
});
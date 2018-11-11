@extends('layouts.app')
@section('content')
 <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}">

    <form action="{{ route('store.register') }}" method="POST">
        @csrf
        <div class="container-register">
            <div class="bg-register">
                <h3 align="center" style="margin-bottom: 50px">iHALLO Register</h3>

                <h5 class="py-2">Account</h5>
                <hr>
                <div class="form-group row">
                    <label for="username" class="col-sm-1 col-form-label">Username</label>
                    <div class="col-sm-6">
                        <input type="text" name="username" class="form-control" placeholder="Username" id="username" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-1 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email" name="email" class="form-control" placeholder="email" id="email" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-1 col-form-label">Password</label>
                    <div class="col-sm-3">
                        <input type="password" name="password" class="form-control" placeholder="password" id="password" required>
                    </div>

                    <div class="col-sm-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" id="email" required>
                    </div>

                </div>

                <h5 class="py-2">Name</h5>
                <hr class="py-2">



                <div class="form-group row">
                    <label for="firstname" class="col-sm-1 col-form-label">Firstname</label>
                    <div class="col-sm-3">
                        <input type="text" name="firstname" class="form-control" placeholder="Firstname" id="firstname" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="middle" class="col-sm-1 col-form-label">Middle</label>
                    <div class="col-sm-3">
                        <input type="text" name="middle" class="form-control" id="middle" placeholder="Middle">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lastname" class="col-sm-1 col-form-label">Lastname</label>
                    <div class="col-sm-3">
                        <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Lastname">
                    </div>
                </div>

                <h5 class="py-2">Address</h5>
                <hr class="py-2">

                <div class="form-group row">
                    <label for="road" class="col-sm-1 col-form-label float-right">Road</label>
                    <div class="col-sm-5">
                        <input type="text" name="road" class="form-control" id="road" placeholder="road">
                    </div>
                    
                </div>

                <div class="form-group row">
                    <label for="city" class="col-sm-1 col-form-label">City</label>
                    <div class="col-sm-5">
                        <input type="text" name="city" class="form-control" id="city" placeholder="City">
                    </div>
                    
                    </div>


                 <div class="form-group row">
                    <label for="postcode" class="col-sm-1 col-form-label">Postcode</label>
                    <div class="col-sm-3">
                        <input type="text" name="postcode" class="form-control" id="postcode" placeholder="postcode">
                    </div>
                    
                    </div>


                  <div class="form-group row">
                    <label for="telp" class="col-sm-1 col-form-label float-right">Telephone</label>
                    <div class="col-sm-3">
                        <input type="text" name="phone" class="form-control" id="telp" placeholder="Telp">
                    </div>
                    <label for="mobile" class="col-sm-1 col-form-label" >Mobile</label>
                    <div class="col-sm-3">
                        <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile" required="">
                    </div>
                </div>

                <div class="form-group row" style="margin-top: 40px">
                    <div class="col-sm-7">
                        <button type="submit" name="submit" class="btn btn-primary col-sm-5 float-right">Register</button>
                    </div>
                                       
                </div>
                </div>

                </div>
               
            </div>

        </div>




    </form>


@endsection
@extends('Frontend.utils.master')

@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<div class="signup-modal modal-upper">
    <div class="modal-custom ">
        <div class="bg-white modal-inner shadow-sm radius-20 position-relative">
            <h4 class="text-center mb-4 mb-4 mb-sm-5">Sign Up</h4>
            <div class="padding-box">
                <form action="{{route('saveusers')}}" method="POST" >
                    @csrf
                    <div class="input-block">
                        <input class="input-field" type="text" name="username" placeholder="Name" >
                        <span style="color:red;">
                            @if($errors->first('username'))
                          {{$errors->first('username')}}
                         @endif
                         </span>
                    </div>
                    <div class="input-block">
                        <input class="input-field" type="email" name="email" placeholder="Email" >
                        <span style="color:red;">
                            @if($errors->first('email'))
                          {{$errors->first('email')}}
                         @endif
                         </span>
                    </div>
                    <div class="input-block">
                        <input class="input-field" type="text" name="mobile" placeholder="Mobile No" >
                        <span style="color:red;">
                            @if($errors->first('mobile'))
                          {{$errors->first('mobile')}}
                         @endif
                         </span>
                    </div>
                    <div class="input-block">
                        <input class="input-field" type="password" name="password" placeholder="Password" >
                        <span style="color:red;">
                            @if($errors->first('password'))
                          {{$errors->first('password')}}
                         @endif
                         </span>
                    </div>
                        <button type="submit" class="bg-theme submit-btn">Sign Up</button>
                    <p class="f-14 text-center">Already have an account? <a href="{{route('weblogin')}}" class="cursor-pointer  text-theme fw-600 cursor-pointer  login-btn">Sign In<a> </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('Frontend.utils.master')

@section('content')
@if(session()->has('message'))
<div class="alert alert-success msgrm">
    {{ session()->get('message') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger msgrm">
    {{ session()->get('error') }}
</div>
@endif
<div class="login-modal modal-upper">
    <div class="modal-custom ">
            <div class="bg-white modal-inner shadow-sm radius-20 position-relative">
                <h4 class="text-center mb-4 mb-sm-5">Login</h4>
                <div class="padding-box">
                    <form action="{{route('websitelogin')}}" method="POST">
                        @csrf
                        <div class="input-block">
                            <input class="input-field" type="email" type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="input-block">
                            <input class="input-field" type="password" placeholder="Password" name="password" required>
                        </div>
                        {{-- <span class="d-inline-block f-13 forgot-btn cursor-pointer"><u>Forgot Password?</u></span> --}}
                        <button type="submit" class="bg-theme submit-btn mb-md-5 ">Sign In</button>
                        {{-- <div class="d-flex social-signup mb-3 justify-content-center">
                            <a href="" class="d-inline-block "><img src="{{url('/')}}/webassets/images/sign-google.png"></a>
                            <a href="" class="d-inline-block "><img src="{{url('/')}}/webassets/images/sign-facebook.png"></a>
                            <a href="" class="d-inline-block"><img src="{{url('/')}}/webassets/images/sign-twitter.png"></a>
                        </div> --}}
                        <p class="f-14 text-center">Don't have an account? <a href="{{route('webregister')}}" class="cursor-pointer text-theme fw-600 signup-btn">Sign Up</a> </p>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection

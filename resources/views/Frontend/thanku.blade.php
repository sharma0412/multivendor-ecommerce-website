@extends('Frontend.utils.master')
@section('content')
<style>

</style>
<section class="thnk-umain" >
   <div class="container">
      <div class="row text-center" style="min-height:650px; height:auto;">
        <div class="col-md-8 col-sm-12 mx-auto my-auto">
            <img src="webassets/images/check.png" class="checkico" alt="">
            <h1 class="text-center font-weight-bold thnk-you">Thank You</h1>
            <p>Your Order was completed Successfully.</p>
            {{-- <p class="text-left">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis similique aspernatur expedita vitae asperiores dolore cumque, voluptates quibusdam id rerum voluptate ipsum quisquam repellat libero adipisci esse, explicabo quam excepturi?</p> --}}
            <a href="{{route('home')}}" class="px-5 py-3 radius-50 bg-theme text-white send-btn my-3" type="button">CONTINUE <i class="fa fa-arrow-right " aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
</section>
@endsection

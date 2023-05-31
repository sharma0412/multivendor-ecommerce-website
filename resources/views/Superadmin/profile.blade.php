@extends('Superadmin.utils.master')
@section('content')
<style>
   .btn-blue{
   background-color:#44a2d2;
   }
</style>
<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
               <h4 class="mb-0 font-size-18">Profile</h4>
            </div>

         </div>
      </div>
                            @if(session()->has('message'))
                                        <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                          </div>
                           @endif
      <!-- end page title -->
      <div class="row">
         <div class="col-xl-7">
            <div class="card profile">
               <div class="card-body">
                  <h5 class="mt-0 pb-3 border-bottom">Update Profile</h5>
                  <form action="{{route('updateprofile',auth::id())}}" method="post" enctype="multipart/form-data">
                     @csrf

                     <div class="my-3">
                        <label class="font-weight-bold">Profile picture*</label>
                        <div class="d-flex align-items-center">
                           <img src="{{auth::user()->profile}}" height="100px" width="100px" class="img-fluid mr-3" ><br>
                           <input type="file" name="profile" class="">
                        </div>
                     </div>
                     <div class="d-sm-flex">
                        <div class="col-sm-6 my-3 pl-0 pr-0 pr-sm-1">
                           <label class="font-weight-bold">Name*</label>
                           <input type="text" name="name" class="form-control" value="{{auth::user()->username}}">
                        </div>

                     </div>
                     <div class="my-3">
                        <label class="font-weight-bold">Email*</label>
                        <input type="text" name="email" class="form-control" value="{{auth::user()->email}}" readonly>
                     </div>
                     <div class="my-3 ">
                        <button type="submit" class=" ml-auto  d-block btn text-white btn-blue btn-round px-5">Update</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-xl-5">
            <div class="card ">
               <div class="card-body profile">
                  <form action="{{route('changepass',auth::id())}}" method="post" >
                     @csrf
                     <h5 class="mt-0 pb-3 border-bottom">Change password</h5>
                     <div class="my-3">
                        <label class="font-weight-bold">Current Password*</label>
                        <input type="text" name="password" class="form-control">
                     </div>
                     <span style="color:red;">
                        @if($errors->first('password'))
                      {{$errors->first('password')}}
                     @endif
                     </span>
                     <div class="my-3">
                        <label class="font-weight-bold">New Password*</label>
                        <input type="text" name="new_password" class="form-control">
                     </div>
                     <span style="color:red;">
                        @if($errors->first('new_password'))
                      {{$errors->first('new_password')}}
                     @endif
                     </span>

                     <div class="my-3 ">
                        <button type="submit" class=" ml-auto  d-block btn-blue btn text-white btn-round px-5">Submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- container-fluid -->
</div>

@endsection

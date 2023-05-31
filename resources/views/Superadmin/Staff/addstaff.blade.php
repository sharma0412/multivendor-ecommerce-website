@extends('Superadmin.utils.master')

@section('content')
<style>

</style>
@php
    $id=isset($_GET['id']) ? $_GET['id'] : '';
@endphp
        <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">


                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card col-md-6 d-block mx-auto">
                                    <div class="card-body">
                                        @if($id == '')
                                        <h5 class="card-title">Add Staff</h5>
                                        @else
                                        <h5 class="card-title">Edit Staff</h5>
                                      @endif
                                        <p></p>
                                        @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('savestaff')}}" enctype="multipart/form-data">
                                                   @csrf

                                            <input type="hidden" name="id" value="{{$id}}">
                                            <div class="form-group ">

                                            @if($id != '')
                                            <img src="{{$staff->profile}}" alt="" width="50px;" height="50px;">
                                            @endif
                                            <br>
                                                <label for="example-email-input1" class="col-form-label pt-0">Profile</label>
                                                <div class="">
                                                    <input class="form-control" type="file" name="profile"  value="{{isset($staff->profile) ? $staff->profile : ''}}">
                                                    <span style="color:red;">
                                                        @if($errors->first('profile'))
                                                    {{$errors->first('profile')}}
                                                    @endif
                                                    </span>
                                                </div>
                                            </div>


                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Name</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="username" required value="{{isset($staff->username) ? $staff->username : ''}}">
                                                </div>
                                            </div>
                                          <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Email</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="email" required value=" {{isset($staff->email) ? $staff->email  : ''}} " >
                                                    <span style="color:red;">
                                                        @if($errors->first('email'))
                                                    {{$errors->first('email')}}
                                                    @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Phone</label>
                                                <div class="">
                                                    <input class="form-control" type="number" name="mobile" required value="{{isset($staff->mobile) ? $staff->mobile : ''}}">
                                                </div>
                                            </div>
                                            <label for="example-email-input1" class="col-form-label pt-0">User Access</label><br>

                                            @php
                                            if($id != ''){
                                                $permissionss=isset($staff->adminpermission) ? $staff->adminpermission : '';
                                            $perm=[];
                                          foreach ($permissionss as $key => $value) {
                                          $perm[]=$value->permission_id;

                                          }
                                            }


                                        @endphp


                                           <div class="form-group ">
                                            <div class="permission-item d-flex flex-wrap">
                                                @foreach ($permission as $val)

                                                <div class=" col-sm-3 mb-3 ">
                                                    <p class="mb-1 titl">{{$val->name}}</p>
                                                    <label class="switch" for="checkbox{{$val->id}}">
                                                      <input type="checkbox" id="checkbox{{$val->id}}" value="{{$val->id}}"  name="permission[]" @if(isset($perm)) {{in_array($val->id, $perm) ? 'checked' : ''}} @endif/>
                                                      <div class="slider round"></div>
                                                    </label>
                                                  </div>
                                                  @endforeach

                                            </div>
                                        </div>

                                            <button type="submit" class="btn btn-primary w-lg">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div> <!-- end row -->


                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

            </div>
            <!-- end main content-->

 @endsection

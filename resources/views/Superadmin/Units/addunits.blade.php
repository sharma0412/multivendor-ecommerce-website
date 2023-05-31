@extends('Superadmin.utils.master')

@section('content')
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
                                        <h5 class="card-title">Add Units</h5>
                                        @else
                                        <h5 class="card-title">Edit Units</h5>
                                      @endif
                                        <p></p>
                                        @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('saveunits')}}" enctype="multipart/form-data">
                                                   @csrf

                                            <input type="hidden" name="id" value="{{$id}}">
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Units Name*</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="unit_name" required value="{{isset($units->unit_name) ? $units->unit_name : ''}}">
                                                    <span style="color:red;">
                                                        @if($errors->first('name'))
                                                    {{$errors->first('name')}}
                                                    @endif
                                                    </span>
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

 @endsection


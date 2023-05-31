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
                                        <h5 class="card-title">Add MyList Category</h5>
                                        @else
                                        <h5 class="card-title">Edit MyList Category</h5>
                                      @endif
                                        <p></p>
                                        @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('saveMyListCategory')}}" enctype="multipart/form-data">
                                                   @csrf

                                            <input type="hidden" name="id" value="{{$id}}">
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">MyList Category Name*</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="name" required value="{{isset($MyListCategory->name) ? $MyListCategory->name : ''}}">
                                                    <span style="color:red;">
                                                        @if($errors->first('name'))
                                                    {{$errors->first('name')}}
                                                    @endif
                                                    </span>
                                                </div>
                                            </div>
                                            @if($id != '')
                                            <img src="{{$MyListCategory->image ?? ''}}" alt="" width="50px;" height="50px;">
                                            @endif
                                          <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">MyList Category Image*</label>
                                                <div class="">
                                                    <input class="form-control" type="file" name="image"   >
                                                    <span style="color:red;">
                                                        @if($errors->first('image'))
                                                    {{$errors->first('image')}}
                                                    @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0"> Color*</label>
                                                <div class="">
                                                    <input class="" type="color" name="color" required="" value="{{isset($MyListCategory->color) ? $MyListCategory->color : ''}}" >
                               
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


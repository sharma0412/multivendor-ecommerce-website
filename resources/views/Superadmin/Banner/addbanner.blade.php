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
                                        <h5 class="card-title">Add Banner</h5>
                                        @else
                                        <h5 class="card-title">Edit Banner</h5>
                                      @endif
                                        <p></p>
                                        @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('savebanner')}}" enctype="multipart/form-data">
                                                   @csrf

                                            <input type="hidden" name="id" value="{{$id}}">


                                            <div class="form-group ">
                                                <label for="example-email-input2" class="col-form-label pt-0">Banner Type*</label>
                                                <div class="">
                                                     <label for="web" class="col-form-label pt-0" >Website:</label>
                                                    <input class="" type="radio" id="web" name="imagetype" value="1"  @if($id == '') checked @endif  @if(isset($banner->type)) {{$banner->type == 1 ? 'checked' : ''}} @endif>
                                                    <label for="app" class="col-form-label pt-0">App:</label>
                                                    <input class="" id="app" type="radio" name="imagetype" value="2"  @if(isset($banner->type)) {{$banner->type == 2 ? 'checked' : ''}} @endif>

                                                </div>
                                            </div>
                                            @if($id != '')
                                            <img src="{{$banner->image}}" alt="" width="50px;" height="50px;">
                                            @endif
                                          <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Banner Image*</label>
                                                <div class="">
                                                    <input class="form-control" type="file" name="image"   >
                                                    <span style="color:red;">
                                                        @if($errors->first('image'))
                                                    {{$errors->first('image')}}
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


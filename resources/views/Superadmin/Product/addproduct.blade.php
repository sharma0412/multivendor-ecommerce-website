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
                                        <h5 class="card-title">Add Product</h5>
                                        @else
                                        <h5 class="card-title">Edit Product</h5>
                                      @endif
                                        <p></p>
                                        @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <form method="post" action="{{route('saveproduct')}}" enctype="multipart/form-data">
                                                   @csrf

                                            <input type="hidden" name="id" value="{{$id}}">

                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Category*</label>
                                                <div class="">
                                                    <select class="form-control"  name="catid" required>
                                                        <option value="" class="d-none">Choose Category</option>

                                                        @foreach ($category as $val)
                                                        <option value="{{$val->id}}" @if(isset($product->name)) {{$product->cat_id == $val->id ? 'selected' : ''}} @endif>{{$val->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Product Name*</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="name" required="" value="{{isset($product->name) ? $product->name : ''}}">
                                                </div>
                                            </div>
                                            @if($id != '')
                                            <img src="{{$product->image}}" alt="" width="50px;" height="50px;">
                                            @endif
                                          <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Product Image*</label>
                                                <div class="">
                                                    <input class="form-control" type="file" name="image"   >
                                                    <span style="color:red;">
                                                        @if($errors->first('image'))
                                                    {{$errors->first('image')}}
                                                    @endif
                                                    </span>
                                                </div>
                                            </div>

                                             @if($id != '')
                                             @if($productImages)
                                             @foreach($productImages as $images)

                                            <span class="position-relative mr-3">
                                                <img  src="{{$images->image}}" alt="" width="100px;" height="100px;" style="object-fit: contain;">
                                               <a onclick="return confirm('Are you sure want to delete it!')" href="{{route('deleteimage',$images->id)}}" class="position-absolute anchor-div bg-danger" style="    padding: 0px 7px;
                                                margin-left: -18px;
                                                margin-top: 8px; border-radius: 10px; "> <span class="text-white">x</span></a>
                                            </span>

                                            @endforeach
                                            @endif
                                            @endif
                                            <br>
                                        <label for="example-email-input12" class="col-form-label pt-0">Product Multiple Image</label>
                                        <div class="form-group row tip1" >
                                            <div class="col-sm-9 d-flex align-items-center mb-2">
                                                <input type="file" id="example-email-input12" class="form-control"   name="multipleimages[]"  />
                                                <i class="fa fa-plus pl-2" id="btn1"></i>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="example-email-input1" class="col-form-label pt-0"> Color*</label>
                                            <div class="">
                                                <input class="" type="color" name="colorcode" required="" value="{{isset($product->colorcode) ? $product->colorcode : ''}}" >

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#btn1").click(function(){
            $(".tip1").append('<div class="col-sm-9 d-flex align-items-center mb-2" id="inputFormRow1"><input type="file" class="form-control"  name="multipleimages[]"  ><i class="fa fa-minus pl-2 " id="removeRow1" ></i></div>');
        });
        $(document).on('click', '#removeRow1', function () {
            $('#inputFormRow1').remove();
        });

    });
</script>

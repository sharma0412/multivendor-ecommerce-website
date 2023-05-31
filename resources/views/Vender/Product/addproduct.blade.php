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
                                        <form method="post" action="{{route('savevenderproduct')}}" enctype="multipart/form-data">
                                                   @csrf

                                            <input type="hidden" name="id" value="{{$id}}">

                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Product*</label>
                                                <div class="">
                                                    <select class="form-control"  name="Product" required>
                                                        <option value="" class="d-none">Choose Product</option>

                                                        @foreach ($Product as $val)
                                                        <option value="{{$val->id}}" @if(isset($VenderProduct->product_id)) {{$VenderProduct->product_id == $val->id ? 'selected' : ''}} @endif>{{$val->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Unit*</label>
                                                <div class="">
                                                    <select class="form-control"  name="unit_name" required>
                                                        <option value="" class="d-none">Choose Unit Value</option>

                                                        @foreach ($units as $val)
                                                        <option value="{{$val->unit_name}}" @if(isset($VenderProduct->unit_name)) {{$VenderProduct->unit_name == $val->unit_name ? 'selected' : ''}} @endif>{{$val->unit_name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Qty*</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="qty" required="" value="{{isset($VenderProduct->qty) ? $VenderProduct->qty : ''}}">
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Market Price*</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="market_price" required="" value="{{isset($VenderProduct->market_price) ? $VenderProduct->market_price : ''}}">
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Selling Price*</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="selling_price" required="" value="{{isset($VenderProduct->selling_price) ? $VenderProduct->selling_price : ''}}">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Description*</label>
                                                <div class="">
                                                    <textarea class="form-control" type="text" name="description" required="" value="{{isset($VenderProduct->description) ? $VenderProduct->description : ''}}">{{isset($VenderProduct->description) ? $VenderProduct->description : ''}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="example-email-input1" class="col-form-label pt-0">Stock*</label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="stock" required="" value="{{isset($VenderProduct->stock) ? $VenderProduct->stock : ''}}">
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


@extends('Superadmin.utils.master')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                           <div class="d-flex justify-content-between align-items-center">
                               <h5 class="card-title mb-0">Product List</h5>
                               <a href="{{route('addvenderproduct')}}" class="btn-primary btn btn-md">Add Product</a>
                           </div>
                       </p>
                       @if(session()->has('message'))
                       <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>

                                    <th>S.NO</th>
                                    <th>Product</th>
                                    <th>Market Price</th>
                                    <th>Selling Price</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Units</th>
                                    <th>Qty</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($product as $val)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$val->product->name}}</td>
                                    <td>{{$val->market_price}}</td>
                                    <td>{{$val->selling_price}}</td>
                                    <td>{{$val->description}}</td>
                                    <td>{{$val->stock}}</td>
                                    <td>{{$val->unit_name}}</td>
                                    <td>{{$val->qty}}</td>
                                    <td><a href="{{route('addvenderproduct','id='.$val->id)}}" class="btn-primary btn btn-md"><i class="far fa-edit"></i></td>
                                 </tr>
                                 @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div> <!-- end col -->
     </div> <!-- end row -->





 </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->



@endsection

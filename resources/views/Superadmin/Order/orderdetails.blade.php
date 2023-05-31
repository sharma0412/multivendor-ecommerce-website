@extends('Superadmin.utils.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-between align-items-center">
                               <h5 class="card-title mb-0">Orders Details</h5>
                               <br>
                           </div>
                           <p class="d-flex  align-items-center">Order Id : <b> {{ $order->id}}</b></p>
                           <p class="d-flex  align-items-center">Total Amount : <b> {{ $order->amount}}</b></p>
                           <p class="d-flex  align-items-center">Purchase Date : <b> {{ $order->created_at}}</b></p>
                           <p class="d-flex  align-items-center"> Order Status : <b> @if( $order->status == 0) Ongoing @else Dileverd @endif</b></p>
                            </div>
                           
                            <div class="col">
                                <div class="d-flex justify-content-between align-items-center">
                               <h5 class="card-title mb-0">Address</h5>
                               <br>
                           </div>
                           @if($order->useraddress)
                           <p class="d-flex  align-items-center">Name : <b>{{$order->useraddress->first_name}} {{$order->useraddress->last_name}} <br></b></p>
                           <p class="d-flex  align-items-center">Contact : <b> {{$order->useraddress->contact}} <br></b></p>
                           <p class="d-flex  align-items-center">House No : <b>{{$order->useraddress->houseno}}</b></p>
                           <p class="d-flex  align-items-center">landmark : <b>{{$order->useraddress->landmark}} <br></b></p>
                           <p class="d-flex  align-items-center">Address : <b> {{$order->useraddress->address}}</b></p>
                           <!-- <p class="d-flex  align-items-center">City : <b> {{$order->useraddress->city}}</b></p>
                           <p class="d-flex  align-items-center">Area : <b> {{$order->useraddress->area}} <br></b></p> -->
                           <p class="d-flex  align-items-center">Pincode : <b> {{$order->useraddress->pincode}}</b></p>
                           @endif
                                        </div></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
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
                                        @if(Auth::user()->role == 0)
                                        <th>Vendor Name</th>
                                        @endif
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>User Name</th>
                                        <th>Email Address</th>
                                        
                                        <th>Quantity</th>
                                        <th>price</th>
                                        

                                    </tr>
                                </thead>
                               <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @if($OrderItem)
                                    @foreach ($OrderItem as $val)
                                    @if($order->vendor)
                                    @if($val->product)
                                    @php
                                    $price = App\Models\VenderProduct::where('vendor_id',$order->vendor->id)->where('product_id',$val->product->id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{$i++}}</td>
                                        @if(Auth::user()->role == 0)
                                        <td>{{$order->vendor->username}}</td>
                                        @endif
                                        <td><img src="{{$val->product->image}}" width="100" height="100" alt=""></td>
                                        <td>{{$val->product->name ?? ''}}</td>
                                        <td>{{$order->user->username ?? ''}}</td>
                                        <td>{{$order->user->email ?? ''}}</td>
                                        
                                        <td>{{$val->quantity ?? ''}} </td>
                                        <td>{{$price->selling_price ?? ''}}</td>
                                       
                                 </tr>
                                 @endif
                                 @endif
                                 @endforeach
                                 @endif
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div> <!-- end col -->
     </div> <!-- end row -->
 </div> <!-- container-fluid -->
</div>
</div>
<!-- End Page-content -->
@endsection

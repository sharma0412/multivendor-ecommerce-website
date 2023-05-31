@extends('Superadmin.utils.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                	<div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Store Details</h5>
                        </div>
                        <div class="card-body">
                           	<div class="d-flex justify-content-between align-items-center">
                           		<div class="row">
                           			<div class="col-sm-6">
                           				<div class="">
                           					<label for="img">Image:</label>
                           					<img src="{{$vendor->profile}}" class="rounded-circle" id="img" width="100px;" >
                           				</div>
                           			</div>
                           			<div class="col-sm-6">
                           				<div class="form-group">
                           					<label for="">Name:</label>
                           					<p  class="" >{{$vendor->username}}</p>
                           				</div>
                           				<div class="form-group">
                           					<label for="">Email:</label>
                           					<p  class="" >{{$vendor->email}}</p>
                           				</div>

                           			</div>
                           		</div>
                           	</div>
                        </div>
                     </div>
                    <div class="card">
                        <div class="card-body">
                           <div class="d-flex justify-content-between align-items-center">
                               <h5 class="card-title mb-0">Store Order</h5>
                           </div>
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
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $i=1;

                                    @endphp
                                    @if($vendor)
                                    @foreach ($vendor->order as $val)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$val->orderitem->product->name}}</td>
                                        <td>{{$val->orderitem->quantity}}</td>
                                        <td>{{$val->amount}}</td>

                                        <td>
                                           @if($val->status == 0)
                                             <button  class="btn-primary btn btn-md" value="1" name="status">On Going</button>
                                             @else
                                             <button  class="btn-success btn btn-md" value="2" name="status">Deliverd</button>
                                             @endif
                                     </td>
                                 </tr>
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
    <!-- End Page-content -->
</div>
@endsection

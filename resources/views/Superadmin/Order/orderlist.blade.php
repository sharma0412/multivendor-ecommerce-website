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
                               <h5 class="card-title mb-0">Orders List</h5>
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
                                        @if(Auth::user()->role == 0)
                                        <th>Vendor Name</th>
                                        @endif
                                        <th>User Name</th>
                                        <th>Email Address</th>
                                        <th>Amount</th>
                                        <th>Order Details</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @if($order)
                                    @foreach ($order as $val)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        @if(Auth::user()->role == 0)
                                        <td>{{$val->vendor->username ?? ''}}</td>
                                        @endif
                                        <td>{{$val->user->username ?? ''}}</td>
                                        <td>{{$val->user->email ?? ''}}</td>
                                        <td>{{$val->amount ?? ''}}</td>
                                        <td><a href="{{route('order_details',$val->id)}}"><i class="fa fa-eye"></i></a></td>
                                        @if(Auth::User()->role == 0)
                                        <td>@if($val->status == 1) {{'Packing'}} @elseif($val->status == 2) {{'On Going'}} @elseif($val->status == 3) {{'Deliverd'}} @elseif($val->status == 0) {{'Order Confirm'}} @endif</td>
                                            @else
                                            <td>
                                                <select name="status" data-userid="{{$val->id}}" class="form-control changeOderStatus" >
                                                    <option value="0" <?= ($val->status == 0)?'selected':'' ?> >Order Confirm</option>
                                                    <option value="1" <?= ($val->status == 1)?'selected':'' ?> >Packing</option>
                                                    <option value="2" <?= ($val->status == 2)?'selected':'' ?> >On Going</option>
                                                    <option value="3" <?= ($val->status == 3)?'selected':'' ?> >Deliverd</option>
                                                </select>
                                        </td>
                                         @endif

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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.changeOderStatus').change(function(){
         var changeOderStatus = $(this).val();
         var userid = $(this).attr('data-userid');
         var data = 'status=' + changeOderStatus + '&id=' + userid;
        $.ajax({
            type: 'GET',
            url: '{{route('orderstatus')}}',
            data: data,
            beforeSend: function() {},
            success: function(response) {
                if (response.success == 'success') {
                // alert('Status updated successfully');
                }else{
                    alert(response);
                }

            }
        });
        });
    });
</script>
<!-- End Page-content -->
@endsection

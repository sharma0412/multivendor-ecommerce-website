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
                               <h5 class="card-title mb-0">Store List</h5>
                               <a href="{{route('addvendor')}}" class="btn-primary btn btn-md mb-2">Add Store</a>
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
                                            <th>Image</th>
                                            <th>User Name</th>
                                            <th>Email Address</th>
                                            <th>Status</th>
                                            {{-- <th>Permission</th> --}}
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach ($vendor as $val)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td> <img src="{{$val->profile}}" alt="" width="50px;" height="50px;"></td>
                                            <td>{{$val->username}}</td>
                                            <td>{{$val->email}}</td>
                                            <td>
                                                <form action="{{route('vendorstatus',$val->id)}}" method="post">
                                                 @csrf
                                                 @if($val->status == 1)
                                                 <button  class="btn-primary btn btn-md" value="1" name="status">Active</button>
                                                 @else
                                                 <button  class="btn-danger btn btn-md" value="0" name="status">Deactive</button>
                                                 @endif
                                             </form>

                                         </td>
                                         {{-- <td>{{$val->permission}}</td> --}}
                                         <td><a href="{{route('addvendor','id='.$val->id)}}" class="mr-2 btn-primary btn btn-md"><i class="far fa-edit "></i></a><a href="{{route('vendordetails','id='.$val->id)}}" class="btn-primary btn btn-md"><i class="far fa-eye"></i></a></td>
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
</div>
@endsection

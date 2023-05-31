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
                                         <h5 class="card-title mb-0">MyList Category</h5>
                                        <a href="{{route('addMyListCategory')}}" class="btn-primary btn btn-md">Add MyList Category</a>
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
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                                </thead>

                                                <tbody>
                                                    @php
                                                        $i=1;
                                                    @endphp
                                                    @foreach ($MyListCategory as $val)
                                                    <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>
                                                        <img src="{{$val->image}}" alt="" width="50px;" height="50px;">
                                                    </td>
                                                    <td>{{$val->name}}</td>
                                                    <td>
                                                        <form action="{{route('MyListCategorystatus',$val->id)}}" method="post">
                                                               @csrf
                                                            @if($val->status == 1)
                                                            <button  class="btn-primary btn btn-md" value="1" name="status">Active</button>
                                                            @else
                                                            <button  class="btn-danger btn btn-md" value="2" name="status">Deactive</button>
                                                            @endif
                                                        </form>

                                                    </td>
                                                    <td><a href="{{route('addMyListCategory','id='.$val->id)}}" class="btn-primary btn btn-md"><i class="far fa-edit"></i></td>
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

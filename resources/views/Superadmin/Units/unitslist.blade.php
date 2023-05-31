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
                                         <h5 class="card-title mb-0">Unit Names List</h5>
                                        <a href="{{route('addunits')}}" class="btn-primary btn btn-md">Add Units</a>
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
                                                    <th>Unit Names</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                                </thead>

                                                <tbody>
                                                    @php
                                                        $i=1;
                                                    @endphp
                                                    @foreach ($units as $val)
                                                    <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$val->unit_name}}</td>
                                                    <td>
                                                        <form action="{{route('unitstatus',$val->id)}}" method="post">
                                                               @csrf
                                                            @if($val->status == 1)
                                                            <button  class="btn-primary btn btn-md" value="1" name="status">Active</button>
                                                            @else
                                                            <button  class="btn-danger btn btn-md" value="2" name="status">Deactive</button>
                                                            @endif
                                                        </form>

                                                    </td>
                                                    <td><a href="{{route('addunits','id='.$val->id)}}" class="btn-primary btn btn-md"><i class="far fa-edit"></i></td>
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

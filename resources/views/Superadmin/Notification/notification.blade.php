@extends('Superadmin.utils.master')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- end page title -->
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="card col-md-6 d-block mx-auto">
                            <div class="card-body">
                                <h1 class="card-title">Notification</h1>
                                <p></p>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <form method="post" action="{{ route('notificationSend') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group ">
                                        <label for="example-email-input1" class="col-form-label pt-0">Users List</label>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <select id="multiple" class="js-states form-control userslist" multiple  name="users[]" >
                                                @foreach ($users as $singleuser)
                                                <option value="{{$singleuser->id}}" >{{$singleuser->username}}</option>
                                                @endforeach
                                           </select>
                                         <span class="text-right">All <input type="checkbox" name="alluser" id="alluser"></span>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="example-email-input1" class="col-form-label pt-0">Title</label>
                                        <div class="">
                                            <input class="form-control" type="text" name="title" required  value="">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="example-email-input1" class="col-form-label pt-0">Message</label>
                                        <div class="">
                                            <textarea class="form-control" type="text" name="message" required  value=""></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <span class="text-danger errmsg"></span>
                                    </div>

                                    <button type="button" class="btn btn-primary w-lg toastrDefaultSuccess">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
      $("#multiple").select2({
          placeholder: "Select users",
          allowClear: true
      });

      $(document).ready(function() {
        $(".toastrDefaultSuccess").click(function() {
            var userslist = $('.userslist').val();
            var alluser = $('#alluser').prop('checked');

            if(userslist != '' || alluser == true) {
                $('.errmsg').html('');
                $('.toastrDefaultSuccess').attr('type','submit');
            }else{
                $('.toastrDefaultSuccess').attr('type','button');
                $('.errmsg').html('Please Select User');
            }
        });
        });

    </script>
@endsection

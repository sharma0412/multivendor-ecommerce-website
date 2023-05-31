@if(Auth::user()->role != 3 )
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>

        <meta charset="utf-8" />
        <title>Dashboard |{{env('APP_NAME')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{env('APP_DESCRIPTION')}}" name="description" />
        <meta content="{{env('APP_AUTHOR')}}" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{env('APP_FAVICON')}}">

        <!-- DataTables -->
    <link href="{{url('/')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
     <link href="{{url('/')}}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{ url('/')}}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ url('/')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ url('/')}}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    </head>
<body data-topbar="dark">
    <div id="layout-wrapper">
        @include('Superadmin.utils.head')
        @include('Superadmin.utils.sidebar')

         @yield('content')
    </div>
    @include('Superadmin.utils.footer')

</body>
</html>
@else
<script>window.location = "/";</script>
@endif
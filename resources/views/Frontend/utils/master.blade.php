<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" >
        <title>APP NAME</title>
        <!-- fontawesome -->
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/webassets/css/all.css">
        <!-- bootstrap -->
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/webassets/css/bootstrap.min.css">
        <!-- slider -->
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/webassets/css/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/webassets/css/nice-select.css">
        <!-- font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- custom -->
        <link rel="stylesheet" href="{{url('/')}}/webassets/css/web.css">
        <link rel="stylesheet" href="{{url('/')}}/webassets/css/responsive.css">
    </head>
<body>

        @include('Frontend.utils.head')

         @yield('content')

    @include('Frontend.utils.footer')
<script >
    function initialize(type) {
        if (type == 'model') {
        var input=   document.getElementById("pac-input");
        }
        if (type == 'header') {
        var input=   document.getElementById("pac-input2");
        }
        if (type == 'checkoutadd') {
        var input=   document.getElementById("pac-input3");
        }
        if (type == 'checkoutedit') {
        var input=   document.getElementById("pac-input4");
        }

     var autocomplete = new google.maps.places.Autocomplete(input);
     autocomplete.addListener('place_changed', function () {
            var completeadd = $('.search-addrs').val();
                var place = autocomplete.getPlace();
              var lat = place.geometry['location'].lat();
              var lng = place.geometry['location'].lng();
              address = place.formatted_address;
              var data = 'address=' + address + '&lat=' + lat + '&lng=' + lng;
                if (type != 'checkoutadd' && type != 'checkoutedit') {
                var data = 'address=' + address + '&lat=' + lat + '&lng=' + lng + '&type=' + 'checkout';
                }
                $.ajax({
                    url:"{{route('guestaddress')}}",
                    method:"POST",
                    data:data,
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(res){
                        console.log(res)
                        if (type != 'checkoutadd' && type != 'checkoutedit') {
                            $('.searchmodel').css('display','none');
                            $('body').css('overflow','scroll');
                            $('.headersearch').val(address);
                            location.reload();
                        }
                    }
                })
            });
    }
    $('.pac-input').keyup(function(){
        var type = $(this).attr('data-id');
        initialize(type);
    });
</script>
</body>
</html>

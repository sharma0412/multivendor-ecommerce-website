@php $cartcount= App\Models\Cart::where('user_id', Auth::id())->count();

@endphp

<style type="text/css">
    .pac-container{z-index: 99999;}
    .pac-container .pac-logo{z-index: 9999!importan;}
    body{overflow: hidden;}
</style>
<header class="header-block01 header-block02">
    <div class="container">
        <div class="d-flex justify-content-between w-100">
            <div class="left-side-header d-flex">
                <a class="d-inline-block" href="/">
                   <img src="{{url('/')}}/webassets/images/listogetlogo_transparent.png" class="header-logo">
                </a>
                <!-- <div class="searchbar-block ml-xl-4 ml-sm-3 ml-0 mr-sm-3 ">
                    <img src="{{url('/')}}/webassets/images/search.png" class="search-icon">
                    <input type="search" class="search-input" placeholder="Search for products..">
                    <button type="button" class="search-submit-btn">Search</button>
                </div> -->
                 <span href="" class=" bg-white rounded-circle  loc-icon ml-md-2">
                    <form role="location" method="get" class="search-form" action="">
                       <label>
                            <input type="location" class="pac-input search-field w-100 headersearch" placeholder="Enter Location " data-id="header" id="pac-input2" value="{{Session::has('address')?Session::get('address'):''}}" name="s"  title="Search for:" />
                        </label>
                    </form>
                 </span>
            </div>
            <div class="right-side-header d-flex align-items-center">
                <!-- test -->
                <span class="openGlobalSearch cart-btn bg-white rounded-circle mr-xl-4  mr-md-2 ml-md-5">
                <img src="{{url('/')}}/webassets/images/search-them.png">
                </span>
                <!-- test -->
                <a href="{{route('webcart')}}" class="cart-btn bg-white rounded-circle mr-xl-4 mr-md-2">
                <img src="{{url('/')}}/webassets/images/cart.png">
                <span class="cart-number">{{$cartcount}}</span>
                </a>
                <div class="dropdown">
                    <!-- if not login -->
                    @if(Auth::user() == '')
                    <a class="bg-white user-btn dropdown-toggle login-btn" href="{{route('weblogin')}}" >
                       <span class="text-theme mr-2 d-none d-sm-inline-block ">Login/Signup</span>
                       <img src="{{url('/')}}/webassets/images/enter.png" class="d-inline-block d-sm-none">
                    </a>
                    <!-- -if loginned -->
                   @else
                  <button class="bg-white user-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="text-theme mr-2 d-none d-sm-inline-block">{{Auth::user()->username}}</span><img src="{{url('/')}}/webassets/images/user.png" class="">
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        {{-- <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a> --}}
                        <a class="dropdown-item" href="{{route('weblogout')}}">Logout</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="globalSearch" style="display: none;">
            <div class=" text-center my-4 d-flex">
                <input placeholder="search" type="text" class="autoComplt form-control col-md-6 mx-auto serch-border-p position-relative">
                <span class="position-absolute cross-ico"><i class="fa fa-times mt-2" aria-hidden="true"></i></span>
            
           </div>
           <div class="col-md-6 mx-auto autoCompltResult" style="display: none;">
               <ul class="list-unstyled listing-serch border px-4 py-2">

                  <!-- <li class="d-flex"><span><img src="https://res.cloudinary.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_80,h_80,c_fill/zmdjforfkj0afhfgd9pk" class="rounded serch-under-img"></span> <p class="ml-3">Vishal <br><span class="span-item">vk rana</span></p></li>
            
                    <li class="d-flex"><span><img src="https://res.cloudinary.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_80,h_80,c_fill/zmdjforfkj0afhfgd9pk" class="rounded serch-under-img"></span> <p class="ml-3">Vishal <br><span class="span-item">vk rana</span></p></li>

                    <li class="d-flex"><span><img src="https://res.cloudinary.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_80,h_80,c_fill/zmdjforfkj0afhfgd9pk" class="rounded serch-under-img"></span> <p class="ml-3">Vishal <br><span class="span-item">vk rana</span></p></li>

                    <li class="d-flex"><span><img src="https://res.cloudinary.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_80,h_80,c_fill/zmdjforfkj0afhfgd9pk" class="rounded serch-under-img"></span> <p class="ml-3">Vishal <br><span class="span-item">vk rana</span></p></li>

                     <li class="d-flex"><span><img src="https://res.cloudinary.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_80,h_80,c_fill/zmdjforfkj0afhfgd9pk" class="rounded serch-under-img"></span> <p class="ml-3">Vishal <br><span class="span-item">vk rana</span></p></li>

                      <li class="d-flex"><span><img src="https://res.cloudinary.com/swiggy/image/upload/fl_lossy,f_auto,q_auto,w_80,h_80,c_fill/zmdjforfkj0afhfgd9pk" class="rounded serch-under-img"></span> <p class="ml-3">Vishal <br><span class="span-item">vk rana</span></p></li> -->
                  
               </ul>
           </div>
        </div>
    </div>
</header>
<div id="map"></div>



<div class="modal  searchmodel" tabindex="-1" role="dialog" style="backdrop-filter:blur(12px);border-radius: 20px;">
          <div class="modal-dialog" role="document" style="margin-top: 10%;">
            <div class="modal-content" style="object-fit: cover;height: auto;background-image: url('{{url('/')}}/webassets/images/Group 49.png');border-radius: 30px;background-color: #cbdce2">
              <div class="modal-body mt-2 mb-5" style="">
                <div class=" mx-auto text-center mt-4" style="width: 100%;"><img src="{{url('/')}}/webassets/images/Group 50.png" class="mx-auto" style="height: 75px;width: 75px;"></div>
                <h3 class="text-center text-grey mt-4 ">Search Your Location</h3>
                
                <input type="text"  name="" data-id="model" class="pac-input rounded form-control w-75 mx-auto mt-4" id="pac-input" style="border-radius: 50px!important;z-index: 9999" placeholder="Search Location">
              </div>
              
            </div>
          </div>
       </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
   <script src='https://maps.googleapis.com/maps/api/js?v=3e&libraries=places&key=AIzaSyBPBkRhatOXakgdTPGwdp17VQX2tMSHdVI'></script>
<!-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiPf_dTs_F-Ah4xyuGKsHV-69k-uAtVSw&callback=initMap&libraries=places&v=weekly"
      async
    ></script>   -->

<script type="text/javascript">
    $(document).ready(function(){
        if ($('.headersearch').val() != '') {
            $('.searchmodel').css('display','none');
            $('body').css('overflow','scroll');
        }else{
            $('.searchmodel').css('display','block');
            $('body').css('overflow','hidden');
        }
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.openGlobalSearch').click(function(){
            $('section').toggle();
            $('.globalSearch').toggle();
        })
        $('.cross-ico').click(function(){
            $('section').toggle();
            $('.globalSearch').toggle();
        })
        $('.autoComplt').keyup(function(){
            $('.autoCompltResult').show();

        })
        $('.autoComplt').keyup(function() {
            $('.autoCompltResult').show();
            var query = $(this).val();
            // call to an ajax function
            var data = 'query=' + query;
            $.ajax({
                url:"{{route('globalsearch')}}",
                method:"POST",
                headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
                data:data,
                success:function (data) {
                    $('.autoCompltResult').html(data.html);
                    
                }
            })
        });
    })
</script>


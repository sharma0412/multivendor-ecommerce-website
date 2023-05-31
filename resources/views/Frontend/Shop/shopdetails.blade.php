@extends('Frontend.utils.master')

@section('content')
@php
 $catid = isset($_GET['catid']) ? $_GET['catid']: "";
 @endphp

<div class="page-content">
    <div class="breadcrumb-div bg-theme">
        <div class="container">
            <ul class="breadcrumb-custom mb-0 bg-none">
                <li><a href="{{route('webhome')}}" >Home</a></li>
                <li><a href="" >Shops</a></li>
                <li class="on"> Natural Grocers</li>
            </div>
        </div>
        @if(session()->has('message'))
        <div class="alert alert-success msgrm">
            {{ session()->get('message') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger msgrm">
            {{ session()->get('error') }}
        </div>
        @endif
        <section class="shop-banner-block" style="background:url('{{$user->profile}}')">
            <div class="container h-100">
                <div class="shop-text ">
                    <h3 class="text-white text-uppercase display-4 fw-600 mb-3">{{$user->username}}</h3>
                    <div class="d-flex align-items-center">
                       <img src="{{url('/')}}/webassets/images/shop-location.png" class="mark-20">
                       <span class="f-19 ml-2">{{$user->address}}</span>
                   </div>
                   <ul class="rating-shop-ul mt-3 list-unstyled d-flex">
                     <li><img src="{{url('/')}}/webassets/images/star.png"></li>
                     <li><img src="{{url('/')}}/webassets/images/star.png"></li>
                     <li><img src="{{url('/')}}/webassets/images/star.png"></li>
                     <li><img src="{{url('/')}}/webassets/images/star.png"></li>
                     <li><img src="{{url('/')}}/webassets/images/blank-star.png"></li>
                 </ul>
                 <p class="f-17 mb-3">{{$user->description}}</p>
             </div>
         </div>
     </section>
     {{-- @if ($message = Session::get('success'))
     <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif --}}

    <section class="shop-products-block space-6">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-lg-0 mb-5">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="heading-other mb-0">Shop Products</h4>
                            <span class=" bg-theme small-border-xm bg-theme mt-2 mb-sm-0 mb-3"></span>
                        </div>
                        <button class="bg-theme btn d-lg-none" id="show-filters-btn">Product Filters</button>
                    </div>
                    <div class="radius-15 bg-white my-4 overflow-hidden side-filter-bar">
                        <h5 class="bg-theme text-white py-2-5 w-100 font-weight-normal text-center position-relative">Product Filters <span class="d-lg-none close-filter-btn">✕</h5>
                            <div class="px-4 py-4">
                                <h6 class="mb-00">Categories:</h6>
                                <span class=" bg-theme small-border-xm bg-theme mt-2"></span>
                                <ul class="filters-side-list list-unstyled color-second">
                                   @php
                                   $category = explode(',',$user->category);
                                   $cat = App\Models\Category::whereIn('id',$category)->get();

                                   @endphp
                                   @foreach($cat as $cat_name)
                                   <a href="{{route('webshopdetails',$user->id.'?catid='.$cat_name->id)}}" class="categoryid" data-id="{{$cat_name->id}}" >
                                    <li class="side-filter-item {{$catid == $cat_name->id ? 'active-filter' : ''}}">
                                        <span class="one-line">{{$cat_name->name}}</span>
                                        <i class="fas fa-chevron-right text-light-grey"></i>
                                    </li>
                                </a>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 ">
                    <div class="mb-5 d-lg-flex d-sm-flex justify-content-between align-items-center overflow-hidden">
                     <h3 class="heading-other mb-sm-0 mb-4 pr-md-4 one-line">{{$user->username ?? ''}}</h3>
                    <!--  <div class="inner-search-block ">
                        <img src="{{url('/')}}/webassets/images/dark-search.png" class="inner-search-icon">
                        <input class="inner-search-input" placeholder="Search for product…" type="Search">
                    </div> -->
                </div>

                <div class="row">
                    @foreach($cat_product as $prod)
                    @php
                    $VenderProducts = App\Models\VenderProduct::where('product_id',$prod->id)->where('vendor_id',$user->id)->first();
                    @endphp 
                    @if($VenderProducts)
                    <div class="col-sm-6 col-xl-4 shop-product-item">
                        <div class="categorie-bg w-100  mb-2">
                            <a href="{{route('productdetails',$prod->id.'?vendorid='.$user->id)}}" class=" color-1 w-100" style="padding: 6px 33px;border-radius: 10px;display: flex;justify-content:center">
                            @if($VenderProducts->remaining_stock < 1)
                            <img src="{{url('/')}}/stock-out.png">
                            @else
                            <img src="{{$prod->image}}">
                            @endif
                         </a>
                                
                                @if(Auth::check())
                                @if($VenderProducts->remaining_stock < 1)
                                <button type="submit" disabled class="add-to-cart-btn bg-theme ">Add to Cart</button>
                                @else
                                <button type="submit" data-vendorid="{{$user->id}}" data-productid="{{$prod->id}}" data-product_price="{{$VenderProducts->selling_price}}" data-market_price="{{$VenderProducts->market_price}}"  class="add-to-cart-btn bg-theme  addToCart">Add to Cart</button>
                                @endif
                                @else
                                <a href="{{url('/')}}/weblogin"><button type="submit"  class="add-to-cart-btn bg-theme getCurrentUrl">Add to Cart</button></a>
                                @endif
                        </div>
                          
                        
                        <h5 class="text-center mb-0">{{$prod->name}}</h5>
                        <div class="d-flex justify-content-center align-items-center">
                            <span class="text-red f-19 fw-500 mr-2">${{$VenderProducts->selling_price}}</span><span><del>${{$VenderProducts->market_price}}</del></span>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">Quantity: {{$VenderProducts->qty}}
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            
            </div>
        </div>
    </section>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.addToCart').click(function(e){
            e.preventDefault();

         var vendorid = $(this).attr('data-vendorid');
         var productid = $(this).attr('data-productid');
         var product_price = $(this).attr('data-product_price');
         var market_price = $(this).attr('data-market_price');

         var data = 'vendorid=' + vendorid + '&productid=' + productid + '&product_price=' + product_price + '&market_price=' + market_price;
            $.ajax({
                type: 'POST',
                url: '{{route('addtocart')}}',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                data: data,
                success: function(response) {
                    console.log(response);
                    if (response.mestype) {
                        Swal.fire({
                          icon: response.mestype,
                          title: response.mestype,
                          text: response.mes,
                           iconColor: 'white',
                          toast: true,
                          position: 'top-right',
                          showConfirmButton: false,
                          customClass: {
                            popup: 'colored-toast'
                          },
                          timer: 5000,
                          timerProgressBar: true
                        })
                        setTimeout(() => {
                            location.reload();
                        }, 5000);
                    }else{
                        
                    }
                }
            });
        });
        $('.getCurrentUrl').click(function(e){
            e.preventDefault();
            var loginUrl = '{{url("/")}}/weblogin';
            var data = 'currentShopUrl=' + window.location.href;
            $.ajax({
                type: 'POST',
                url: '{{route('saveCurrentUrl')}}',
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                data: data,
                success: function(response) {
                window.location = loginUrl;
                }
            });
        })
    });
</script>

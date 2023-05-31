@extends('Frontend.utils.master')

@section('content')
@php
$vendorid =isset($_GET['vendorid']) ? $_GET['vendorid'] : '';
@endphp
<div class="page-content">
    <div class="breadcrumb-div bg-theme">
        <div class="container">
            <ul class="breadcrumb-custom mb-0 bg-none">
                <li><a href="{{route('webhome')}}" >Home</a></li>
                <li class="on">Shopping Cart</li>
            </ul>
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
    <section class="about-product-item space-6">
          <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
                    <div class=" color-4 text-center product-img-div">
                                @if($VenderProduct->remaining_stock < 1)
                        <img src="{{url('/')}}/stock-out.png" id="zoom-image" >
                        @else
                        <img src="{{$product->image}}" id="zoom-image" >
                        @endif
                        <div class="product-slider-block">
                            <div class="slider--product owl-theme owl-carousel">
                                @if($VenderProduct->remaining_stock > 1)
                                 @if(count($productimages) != 0)
                                <div class="item">
                                    <div class="multiple-img">
                                        <img class="multiple-img-src" src="{{$product->image}}">
                                    </div>
                                </div>
                                @endif
                                @endif
                                @if($VenderProduct->remaining_stock > 1)
                                @foreach($productimages as $images)
                                <div class="item">
                                    <div class="multiple-img">
                                        <img class="multiple-img-src" src="{{$images->image}}">
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                
                            </div>
                        </div>
                     </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <h4 class="mb-3 heading-other">{{$product->name}}</h4>
                    <h5><span class="text-red fw-500 mr-4">${{$VenderProduct->selling_price}}</span><span class="text-light-grey"><del>${{$VenderProduct->market_price}}</del></span></h5>
                    <p class="f-13 color-second mb-3">*Price per {{$VenderProduct->qty}}</p>
                    <p class="f-14 color-second "> Availability : <span class="ml-1">Only {{$VenderProduct->remaining_stock}} left</span></p>

                     <p class="f-14 color-second "> Quantity : <span class="ml-1">{{$VenderProduct->qty}}</span></p>
                    <!-- <div class="number-btns my-3">
                        <button type="button" id="add-count" class="shadow-btn">-</button>
                        <p class="shadow-p ">1</p>
                        <button type="button" id="minus-count" class="shadow-btn">+</button>
                    </div> -->
                    
                            @if($VenderProduct->remaining_stock < 1)
                        <button type="submit" class="buy-btn" disabled><i class="fas fa-shopping-cart mr-2"></i>Add to cart</button>
                                @else
                        <button data-vendorid="{{$vendorid}}" data-productid="{{$VenderProduct->product_id}}" data-product_price="{{$VenderProduct->selling_price}}" data-market_price="{{$VenderProduct->market_price}}" type="submit"  class="buy-btn addToCart"><i class="fas fa-shopping-cart mr-2"></i>Add to cart</button>
                                @endif
                    
                                
                        <p class="f-14 color-second my-4">Category : <span class="ml-1">{{$product->catgeory->name}}</span></p>
                        <div class="desc-box">
                            <h5 class="description-heading">Description</h5>
                            <span class="small-border-xm green03 mt-1 mb-3"></span>
                            <p class="f-14 mb-0">{{$VenderProduct->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
      </section>
      <section class="related-items-block space-6">
          <div class="container">
            <h4 class="  mb-5">Related Items</h4>
            <div class="margin-row d-flex flex-wrap">
                @php

        $products = App\Models\Product::where('cat_id',$product->catgeory->id)->get();
                @endphp
                @foreach($products as $prod)
                @php
        $VenderProducts = App\Models\VenderProduct::where('product_id',$prod->id)->where('vendor_id',$vendorid)->where('product_id','!=',$VenderProduct->product_id)->first();
        @endphp 
                @if($VenderProducts)
                <div class="column-5 shop-product-item">
                     <a href="{{route('productdetails',$prod->id.'?vendorid='.$vendorid)}}" class="categorie-bg color-2 mb-2">
                                @if($VenderProducts->remaining_stock < 1)
                         <img src="{{url('/')}}/stock-out.png">
                                @else
                         <img src="{{$prod->image}}">
                                @endif
                             
                            @if($VenderProducts->remaining_stock < 1)
                         <button type="submit" disabled class="add-to-cart-btn bg-theme ">Add to Cart</button>
                                @else
                         <button type="submit" data-vendorid="{{$vendorid}}" data-productid="{{$prod->id}}" data-product_price="{{$VenderProducts->selling_price}}" data-market_price="{{$VenderProducts->market_price}}" class="add-to-cart-btn bg-theme addToCart">Add to Cart</button>
                                @endif
                           
                                
                     </a>
                    <h5 class="text-center mb-0">{{$prod->name}}</h5>
                       <div class="d-flex justify-content-center align-items-center">
                          <span class="text-red f-19 fw-500 mr-2">${{$VenderProducts->selling_price}}</span><span><del>${{$VenderProducts->market_price}}</del></span>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">Quantity: {{$VenderProducts->qty}}</div>
                 </div>
                 @endif
                 @endforeach

                  
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
            beforeSend: function() {},
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
    });
</script>
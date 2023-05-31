@extends('Frontend.utils.master')
@section('content')
@if(auth::user() && count($cart) != 0)
<div class="page-content">
   <div class="breadcrumb-div bg-theme">
      <div class="container">
         <ul class="breadcrumb-custom mb-0 bg-none">
            <li><a href="{{route('webhome')}}" >Home</a></li>
            <li><a href="{{route('webcart')}}" >Shopping Cart</a></li>
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
   <section class="order-block space-6">
      <div class="container">
         <div class="row">
            <div class="col-xl-8 mb-xl-0 mb-5">
               <div class="order-left-box ">
                  <h4 class="">Order Confirmation</h4>
                  <span class="small-border-xm green03 mt-1 mb-xl-4 mb-5"></span>
                  <div class="order-products-block my-4">
                     <!-- itrm -->
                     @foreach ($cart as $val)
                     @php
                     $VenderProduct = App\Models\VenderProduct::where(['vendor_id'=>$val->vendor_id,'product_id'=>$val->product_id])->first();
                     @endphp
                     <div class="order-product-item d-lg-flex justify-content-between mb-3">
                        <div class="d-flex align-items-center mb-3 about-order-product">
                           <div class="color-7 order-product-img mr-3">
                              <img src="{{$val->product->image}}">
                           </div>
                           <div class="name">
                              <h5 class="one-line">{{$val->product->name}}</h5>
                              <div class="d-flex align-items-center ">
                                 <span class="text-red f-19 fw-500 mr-2 product_price" >${{$val->product_price}}</span><span><del>${{$val->market_price}}</del></span>
                              </div>
                              <span class="text-red f-19 fw-500 mr-2 remaining_stock{{$val->product_id}}" style="display: none;">{{$VenderProduct->remaining_stock}}</span>
                           </div>
                        </div>
                        <div class="order-product-content d-flex align-items-center">
                           <div class="number-btns number-bg my-3">
                              <button type="button" id="add-count" class="shadow-btn minus decrease" data-id="{{$val->product_id}}" data-pid="{{$val->id}}" data-type="1" data-productprice="{{$val->product_price}}" data-qty="{{$val->quantity}}">-</button>
                              <input  class="shadow-p each_quantity quantity{{$val->product_id}}" value="{{$val->quantity}}" data-remain="{{$VenderProduct->remaining_stock}}" data-id="{{$val->product_id}}">
                              <button type="button" id="minus-count"  class="shadow-btn increase inc{{$val->product_id}}"  data-id="{{$val->product_id}}" data-type="2">+</button>
                           </div>
                           <h5 class="actual_price{{$val->product_id}}">${{$val->actual_price}}</h5>
                           <a href="{{route('removecart',$val->id)}}" class="shadow-btn delete-cart-btn"><img src="webassets/images/delete.png"></a>
                        </div>
                     </div>
                     @php
                     $product = App\Models\User::with('vendor')->where('id', $val->vendor_id)->first();

                     @endphp
                     @endforeach
                  </div>
               </div>
            </div>
            <div class="col-xl-4 col-lg-8 ">
               <div class="order-right-box">
                  {{-- <p class="f-15 color-second">There are 2 Items in Your Cart</p> --}}
                  <div class="calculation-box my-4 py-4 ">
                     <p class="d-flex justify-content-between">
                        <span class="fw-600 f-15 " >Sub Total  </span><span class="text-grey subtotalPrice">${{$subtotal}}</span>
                     </p>
                     <p class="d-flex justify-content-between">
                        <span class="fw-600 f-15">Taxes (0%) </span><span class="text-grey">$0</span>
                     </p>
                     <p class="d-flex justify-content-between">
                        <span class="fw-600 f-15">Delivery Charges </span><span class="text-grey">$0</span>
                     </p>
                  </div>
                  <h4 class="d-flex justify-content-between">Total:<span class="fw-600 totalPrice">${{$totalsum}}</span></h4>
                  <a href="{{route('webcheckout')}}" class="btn-theme order-btn my-4 btn" style="text-decoration: none;">Order</a>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="related-items-block space-6">
      <div class="container">
         <h4 class="  mb-5">Add More</h4>
         <div class="margin-row d-flex flex-wrap">
            @if(isset($product->vendor))
            @foreach ($product->vendor as $products)
            <div class="column-5 shop-product-item position-relative">
               <a href="{{route('productdetails',$products->product_id.'?vendorid='.$product->id)}}" class="categorie-bg color-2 mb-2">
                  @if($products->remaining_stock < 1 )
                  <img src="{{url('/')}}/stock-out.png">
                  @else
                  <img src="{{$products->product->image}}">
                  @endif
                   @if($products->remaining_stock < 1 )
               <button type="submit" disabled class="add-to-cart-btn bg-theme ">Add to Cart</button>
               @else
               <button type="submit" data-vendorid="{{$product->id}}" data-productid="{{$products->product_id}}" data-product_price="{{$products->selling_price}}" data-market_price="{{$products->market_price}}"  class="add-to-cart-btn bg-theme  addToCart">Add to Cart</button>
               @endif
               </a>
              


               <h5 class="text-center mb-0">{{$products->product->name}}</h5>
               <div class="d-flex justify-content-center align-items-center">
                  <span class="text-red f-19 fw-500 mr-2">${{$products->selling_price}}</span><span><del>${{$products->market_price}}</del></span>
               </div>
               <p class="f-14 color-second text-center"> Quantity : <span class="ml-1">{{$products->qty}}</span></p>
            </div>
            @endforeach
            @endif
         </div>
      </div>
   </section>
</div>
@else
<section class="py-5 text-center">
   <img src="emptycart.png"  alt="image not found" class="empty-imh">
   <h5 class="font-weight-normal mt-4">No items in your cart</h5>
</section>
@endif
@endsection
<script language="JavaScript"  src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $( document ).ready(function() {
      $( ".each_quantity" ).each(function() {
         var quantity = $(this).val();
         var remain = $(this).attr("data-remain");
         var productid = $(this).attr("data-id");
         if(remain == quantity || remain < quantity){
            $('.inc'+productid).prop('disabled',true);
         }else{
            $('.inc'+productid).prop('disabled',false);
         }
      });
      $(".increase").click(function(){
         var productid = $(this).attr("data-id");
         var  datatype= $(this).attr("data-type");
         $.ajax({
            type: "GET",
            url: '/updatecart',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: { productid:productid, datatype: datatype},
            success: function( data ) {
               $('.quantity'+productid).val(data.quantity);
               $('.actual_price'+productid).text(`$ ${data.actual_price}`);
               $('.subtotalPrice').text(`$ ${data.subtotalPrice}`);
               $('.totalPrice').text(`$ ${data.totalPrice}`);
               var remaining_stock = $('.remaining_stock'+productid).text();
               var quantity = data.quantity;
               if(remaining_stock == quantity || remaining_stock < quantity){
                  $('.inc'+productid).prop('disabled',true);
                  alert('This Product quantity exceed!')
                  return false;
               }else{
                  $('.inc'+productid).prop('disabled',false);
               }
            }
         });
      });
      $(".decrease").click(function(){
         var productid = $(this).attr("data-id");
         var pid = $(this).attr("data-pid");
         var datatype = $(this).attr("data-type");
         $.ajax({
            type: "GET",
            url: '/updatecart',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: { productid:productid, datatype: datatype},
            success: function( data ) {
               $('.quantity'+productid).val(data.quantity);
               $('.actual_price'+productid).text(`$ ${data.actual_price}`);
               $('.subtotalPrice').text(`$ ${data.subtotalPrice}`);
               $('.totalPrice').text(`$ ${data.totalPrice}`);
               var dataquantity = data.quantity;
               if (dataquantity < 1) {
                  alert('Do you want to remove cart item');
                  $.ajax({url: "removecart/"+pid, success: function(result){
                     location.reload();
                  }});
               }
               var remaining_stock = $('.remaining_stock'+productid).text();
               var quantity = data.quantity;
               if(remaining_stock != quantity || remaining_stock > quantity){

                  $('.inc'+productid).prop('disabled',false);
                  return false;
               }
            }
         });
      });
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
   });
</script>

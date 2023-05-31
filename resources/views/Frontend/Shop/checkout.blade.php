@extends('Frontend.utils.master')
@section('content')
@php
$id = '';
$id = isset($_GET['id'])?$_GET['id']:'';

$selectedaddress = App\Models\UserAddress::where('id',$id)->where('user_id',Auth::id())->first();

@endphp
<div class="page-content">
   <div class="breadcrumb-div bg-theme">
      <div class="container">
         <ul class="breadcrumb-custom mb-0 bg-none">
            <li><a href="{{route('webhome')}}" >Home</a></li>
            <li><a href="{{route('webcart')}}" >Shopping Cart</a></li>
            <li class="on">Checkout</li>
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
               <h4 class="">Pick Addresss</h4>
               <span class="small-border-xm green03 mt-1 mb-xl-4 mb-5"></span>
               <div class="address-row my-4">
                  <!-- itrm -->
                  @php
                  $i = 1;
                  @endphp
                  @if($address)
                  @foreach($address as $key => $val)
                  <div class="col-lg-4 col-sm-6 mb-4">
                     <div class="address-item">
                        <div>
                           <h5 class="fw-600">Address {{$i++}}</h5>
                           <p class="f-16 fw-600 mb-1">{{$val->first_name}} {{$val->last_name}}</p>
                           <p class="text-grey mb-1">{{$val->contact}}</p>
                           <p class="text-grey mb-1">House No: {{$val->houseno}}</p>
                           <p class="text-grey mb-1">Landmark: {{$val->landmark}}</p>
                           <p class="text-grey mb-1">Address: {{$val->address}}</p>
                           <!-- <p class="text-grey mb-1">Area: {{$val->area}}</p> -->
                           <p class="text-grey mb-1">Pin code: {{$val->pincode}}</p>
                           <!-- <p class="text-grey mb-1">City: {{$val->city}}</p> -->
                        </div>
                        <div class="d-flex justify-content-between w-100">
                           <a href="{{route('webcheckout','id='.$val->id)}}" class="small-theme-btn "   >Edit</a>
                           <button class="small-theme-btn selectaddress" trigger="click" id="{{$val->id}}">Use This</button>
                        </div>
                     </div>
                  </div>
                  @endforeach
                  @endif

                  <div class="col-lg-4 col-sm-6 mb-4">
                     <div class="address-item text-center ">
                        <div>
                           <img src="webassets/images/address.png" class="add-address-img mb-4">
                        </div>
                        <div>
                           <button type="submit" class="bg-theme text-white f-16 w-100 py-2 radius-20 add-address-btn">Add Address</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-4 col-lg-6 col-md-6 ">
            <div class="order-right-box card-detail-box">
               <h5 class="text-theme text-center mb-4">Enter Card Detail</h5>
               <form action="{{route('payment')}}" method="post">
                @csrf
                <input type="hidden" name="totalCartPrice" value="{{$totalCartPrice}}">
                <div class="form-group mb-3">
                  <label for="">Card Number</label>
                  <input type="text" class="form-control py-4 " required name="card_number" maxlength="16">
               </div>
               <div class="form-group mb-3">
                  <label for="">Name</label>
                  <input type="text" class="form-control py-4" required name="name_on_card">
               </div>
               <div class="form-row mb-4">
                  <div class="form-group col-md-6">
                    <label for="">Expire Month</label>
                    <input type="text" class="form-control py-4" required name="expiry_month">
                 </div>
                 <div class="form-group col-md-6">
                    <label for="">Expire Year</label>
                    <input type="text" class="form-control py-4" required name="expiry_year">
                 </div>
                 <div class="form-group col-md-6 mb-2 ">
                    <label for="">CVV</label>
                    <input type="text" class="form-control py-4 " required name="cvv" maxlength="3">
                 </div>
                 <div class="hiddenaddress"></div>
              </div>
              <button type="submit" class="btn-theme order-btn">Pay ${{$totalCartPrice}}</button>

           </form>
        </div>
     </div>
  </div>
</div>
</section>
@if($id != '')
<!-- edit address modal -->

<div class="editaddress address-modal-outer" style="display: none;">
   <div class=" address-modal">
      <div class="bg-white address-inner shadow-sm radius-20 position-relative">
         <h4 class="text-center mb-4 ">Edit Address</h4>
         <button class="bg-none close-modal" type="button">✖</button>
         <div class="padding-box card-detail-box">
            <p class="mb-4 fw-600">Personal Details</p>
            <form action="{{route('update_useraddress')}}" method="post">
               @csrf
               <div class="form-group  form-row">
                  <input type="hidden" name="add_id" class="add_id" value="{{$id}}">
                  <div class="col-sm-6">
                     <label class="f-14 mb-1">First Name</label>
                     <input type="text" required name="first_name" value="{{$selectedaddress->first_name}}" class="form-control">
                  </div>
                  <div class="col-sm-6">
                     <label class="f-14 mb-1">Last Name</label>
                     <input type="text" required name="last_name" value="{{$selectedaddress->last_name}}" class="form-control">
                  </div>
               </div>
               <div class="form-group ">
                  <label class="f-14 mb-1">Contact Number</label>
                  <input type="tel" required name="contact" value="{{$selectedaddress->contact}}" class="form-control">
               </div>
               <p class="my-4 fw-600">Address</p>
               <div class="form-group  form-row">
                  <div class="col-sm-6">
                     <label class="f-14 mb-1">House No</label>
                     <input type="text" required name="houseno" value="{{$selectedaddress->houseno}}" class="form-control">
                  </div>
                  <div class="col-sm-6">
                     <label class="f-14 mb-1">Landmark</label>
                     <input type="text" required name="landmark" value="{{$selectedaddress->landmark}}" class="form-control">
                  </div>
               </div>
               
               <div class="form-group ">
                     <label class="f-14 mb-1">Address</label>
                     <input type="text" required name="" data-id="checkoutedit" id="pac-input4" class="pac-input form-control" value="{{$selectedaddress->address}}" >
                  </div>
               <div class="form-group ">
                  <div class="col-sm-6 px-0">
                   <label class="f-14 mb-1">Pincode</label>
                   <input type="text" required name="pincode" value="{{$selectedaddress->pincode}}" class="form-control">
                </div>
             </div>
             <div class="text-left my-3">
               <button type="submit" class="bg-theme py-2 px-5 radius-20 text-white f-14 ">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
</div>   
@endif

<!-- add address modal -->
<div class="address-modal-outer">
   <div class=" address-modal">
      <div class="bg-white address-inner shadow-sm radius-20 position-relative">
         <h4 class="text-center mb-4 ">Add Address</h4>
         <button class="bg-none close-modal" type="button">✖</button>
         <div class="padding-box card-detail-box">
            <p class="mb-4 fw-600">Personal Details</p>
            <form action="{{route('save_useraddress')}}" method="post">
               @csrf
               <div class="form-group  form-row">
                  <div class="col-sm-6">
                     <label class="f-14 mb-1">First Name</label>
                     <input type="text" required name="first_name" class="form-control">
                  </div>
                  <div class="col-sm-6">
                     <label class="f-14 mb-1">Last Name</label>
                     <input type="text" required name="last_name" class="form-control">
                  </div>
               </div>
               <div class="form-group ">
                  <label class="f-14 mb-1">Contact Number</label>
                  <input type="tel" required name="contact" class="form-control">
               </div>
               <p class="my-4 fw-600">Address</p>
               <div class="form-group  form-row">
                  <div class="col-sm-6">
                     <label class="f-14 mb-1">House No</label>
                     <input type="text" required name="houseno" class="form-control">
                  </div>
                  <div class="col-sm-6">
                     <label class="f-14 mb-1">Landmark</label>
                     <input type="text" required name="landmark" class="form-control">
                  </div>
               </div>
               
                  <div class="form-group ">
                     <label class="f-14 mb-1">Address</label>
                     <input type="text" required name="address" data-id="checkoutadd" id="pac-input3" class="pac-input form-control">
                  </div>
                  
               
               <div class="form-group ">
                  <div class="col-sm-6 px-0">
                   <label class="f-14 mb-1">Pincode</label>
                   <input type="text" required name="pincode" class="form-control">
                </div>
             </div>
             <div class="text-left my-3">
               <button type="submit" class="bg-theme py-2 px-5 radius-20 text-white f-14 ">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
</div>



<!-- addresss modal end -->
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $( document ).ready(function() {

    $( ".selectaddress" ).click(function() {

      $('.selectaddress').css('background-color','#0d72a0')
      $(this).css('background-color','#154154')
      var addressid = $(this).attr('id');
      $('.hiddenaddress').html('<input type="hidden" name="addressid" value="'+addressid+'">');
   });
    if ($('.add_id').val() != '') {
      $('.editaddress').css('display','block');
   }

   $('.selectaddress').each(function(index){
    if (index == 0) {
      $(this).trigger('click');
    }
   });
});
</script>

@extends('Frontend.utils.master')

@section('content')

        <!--=========Header end========-->
        <!--=========Home bannner======-->
        <section class="home-banner-block bg-white">
            <div class="container">
                <div class="home-banner-text">
                    <h2 class="text-theme display-4 fw-600">Check out our Best Weekly Prices</h2>
                    <p class="">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo</p>
                </div>
           </div>
           <img src="webassets/images/banner-image1.png" class="home-right-banner" id="banner-img">
        </section>
        <section class="select-banner-block">
               <div class="container">
                   <div class="select-banner-slider owl-carousel owl-theme">
                       <div class="item">
                           <div class="bg-white radius-15  select-banner">
                               <img src="webassets/images/select-1.png" class="banner-option">
                           </div>
                       </div>
                       <div class="item">
                           <div class="bg-white radius-15  select-banner">
                                <img src="webassets/images/banner-image1.png" class="banner-option">
                           </div>
                       </div>
                       <div class="item">
                           <div class="bg-white radius-15 select-banner ">
                                <img src="webassets/images/select-1.png" class="banner-option ">
                           </div>
                       </div>
                   </div>
               </div>
           </section>
        <!--=====Home bannner end======-->
        <!--=========categories========-->
        <section class="categories-block bg-white space-6">
            <div class="container">
                <h2 class="text-center heading-title">All Categories</h2>
                <div class="d-flex flex-wrap categories-row">
                    @foreach ($category as $categories)
                    <div class="categorie-item">
                        <a href="{{route('webshops','catid='.$categories->id)}}" class="categorie-bg color-1">
                            <img src="{{$categories->image}}">
                            <h4 class="categorie-title text-capitalize ">{{$categories->name}}</h4>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <a href="{{route('listcategory')}}" class=" fw-500 f-18 "><u>See all</u></a>
                </div>
            </div>
        </section>
        <!--=======categories end=======-->
        <!--==========top picks========-->
        <section class="top-picks-block bg-white">
            <div class="bg-theme text-white text-center py-4">
                <h2 class="heading-title mb-0">This Week Top Picks </h2>
            </div>
            <div class="container">
                <div class="row space-6">
                    @foreach ($product as $Key=>$products)
                        @if($Key==0)
                            <div class=" col-xl-5 first-line">
                                <div class="col-md-12 h-100 px-0 px-lg-0">
                                    <a href="" class="top-pick-item">
                                        <img src="{{$products->image}}">
                                        <h5 class="top-pick-title">{{$products->name}}</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="  col-xl-7 px-lg-0 d-flex flex-wrap second-line px-0">
                        @else
                                <div class="col-sm-6 w-xs-50">
                                    <a href="" class="top-pick-item w-100">
                                        <img src="{{$products->image}}">
                                        <h5 class="top-pick-title">{{$products->name}}</h5>
                                    </a>
                                </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!--======top picks end========-->
        <!--=====Recommended Stores====-->
        <section class="stores-block space-6">
            <div class="titleblock mb-5">
                <h2 class="heading-title">Recommended Stores</h2>
                <p class="f-16 text-grey">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum</p>
            </div>
            <div class="container">
                <div class="row">
                    @foreach ($user as $users)
                    <div class="col-lg-4 col-sm-6 mb-5 px-md-3 px-sm-2 px-3">
                        <a href="{{route('webshopdetails',$users->id)}}" class="shop-item text-decoration-none">
                            <!-- webassets/images/shop-1.jpg -->
                            <img src="{{$users->profile}}" class="shop-img">
                            <div class="shop-bottom bg-white overflow-hidden">
                                <h4 class="shop-title one-line">{{$users->username}}</h4>
                                <div class="d-flex align-items-end overflow-hidden shop--name">
                                    <img src="{{url('/')}}/webassets/images/location.png" class="small-icon mr-1">
                                    <span class="f-14 text-grey one-line">{{$users->address}}</span>
                                </div>
                                <div class="store-rating d-flex ">
                                    <img src="{{url('/')}}/webassets/images/star.png" class="mr-1">
                                    <p class="f-15 mb-0 text-grey">4.0</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--===Recommended Stores end==-->
        <!--===Recommended Products====-->
        <section class="Recommended-products-block space-6 bg-white">
            <div class="titleblock mb-5 mt-sm-2">
                <h2 class="heading-title">Recommended Products</h2>
                <p class="f-16 text-grey">Etiam posuere, sem eget suscipit convallis, nibh metus molestie massa, et finibus nunc purus eget elit. Nunc non velit interdum libero rutrum auctor ut a nulla. Ut ac efficitur velit</p>
            </div>
            <div class="container">
                <div class="slider-rec owl-carousel owl-theme mb-sm-5">
                    <div class="item">
                        <div class="recommended-product-item">
                            <div class="color-1 recommended-product-box">
                                <img src="{{url('/')}}/webassets/images/strawberry.png" class="product-img">
                            </div>
                            <div class="text-center">
                                <h5 class="one-line">Fresh Strawberry</h5>
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="text-red f-19 fw-500 mr-2">$8.99</span><span><del>$12.99</del></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="recommended-product-item">
                            <div class="color-2 recommended-product-box">
                                <img src="{{url('/')}}/webassets/images/Avocado.png" class="product-img">
                            </div>
                            <div class="text-center">
                                <h5 class="one-line">Avocado</h5>
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="f-19 fw-500">$7.99</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="recommended-product-item">
                            <div class="color-3 recommended-product-box">
                                <img src="{{url('/')}}/webassets/images/apple.png" class="product-img">
                            </div>
                            <div class="text-center">
                                <h5 class="one-line">Apple</h5>
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="text-red f-19 fw-500 mr-2">$8.99</span><span><del>$12.99</del></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="recommended-product-item">
                            <div class="color-8 recommended-product-box">
                                <img src="{{url('/')}}/webassets/images/orange.png" class="product-img">
                            </div>
                            <div class="text-center">
                                <h5 class="one-line">Orange</h5>
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="f-19 fw-500">$7.99</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="recommended-product-item">
                            <div class="color-9 recommended-product-box">
                                <img src="{{url('/')}}/webassets/images/pineapple.png" class="product-img">
                            </div>
                            <div class="text-center">
                                <h5 class="one-line">Pineapple</h5>
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="text-red f-19 fw-500 mr-2">$8.99</span><span><del>$12.99</del></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--==Recommended Products end=-->
        <!--=====Products display======-->
        {{-- <section class="space-6 different-products">
            <div class="container">
                <div class="row">
                    @if($cat)
                    @foreach($cat as $categories)
                    <div class="col-lg-4 col-md-6 mb-lg-0 mb-4">
                        <h4 class="border-bottom-title mb-3 mb-lg-4">{{$categories->name}}<span class="small-border green03"></span></h4>
                        <div class="line-products-block">
                            @php
                            $prod = App\Models\Product::where('cat_id',$categories->id)->limit(6)->get();
                            @endphp
                            @if($prod)
                            @foreach($prod as $product)
                            @php
                            $vendorprod = App\Models\VenderProduct::where('product_id',$product->id)->first();

                            @endphp
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{$product->image}}">
                                </div>
                                <div class="line-product-content">
                                    <h5>{{$product->name}}</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="text-red f-19 fw-500 mr-2">{{isset($vendorprod) ? $vendorprod->selling_price : ''}}</span><span><del>{{isset($vendorprod) ? $vendorprod->market_price : ''}}</del></span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>


                    @endforeach
                    @endif
                </div>
            </div>
        </section> --}}
        <section class="space-6 different-products">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-lg-0 mb-4">
                        <h4 class="border-bottom-title mb-3 mb-lg-4">Snacks & Canned Goods<span class="small-border green03"></span></h4>
                        <div class="line-products-block">
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{url('/')}}/webassets/images/milk.png">
                                </div>
                                <div class="line-product-content">
                                    <h5>Organic Milk</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="text-red f-19 fw-500 mr-2">$8.99</span><span><del>$12.99</del></span>
                                    </div>
                                </div>
                            </div>
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{url('/')}}/webassets/images/strawberry.png">
                                </div>
                                <div class="line-product-content">
                                    <h5>Fresh Strawberry</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="text-red f-19 fw-500 mr-2">$8.99</span><span><del>$12.99</del></span>
                                    </div>
                                </div>
                            </div>
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{url('/')}}/webassets/images/apple.png">
                                </div>
                                <div class="line-product-content">
                                    <h5>Fresh Strawberry</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="text-red f-19 fw-500 mr-2">$8.99</span><span><del>$12.99</del></span>
                                    </div>
                                </div>
                            </div>
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{url('/')}}/webassets/images/categorie-10.png">
                                </div>
                                <div class="line-product-content">
                                    <h5>Fresh Strawberry</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="text-red f-19 fw-500 mr-2">$8.99</span><span><del>$12.99</del></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-lg-0 mb-4">
                        <h4 class="border-bottom-title mb-3 mb-lg-4">Cereal & Bakery<span class="small-border yellow03"></span></h4>
                        <div class="line-products-block">
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{url('/')}}/webassets/images/Chocolate-cake.png">
                                </div>
                                <div class="line-product-content">
                                    <h5>Chocolate Cake</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="text-red f-19 fw-500 mr-2">$8.99</span><span><del>$12.99</del></span>
                                    </div>
                                </div>
                            </div>
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{url('/')}}/webassets/images/cake_cream.png">
                                </div>
                                <div class="line-product-content">
                                    <h5>Fresh Strawberry</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="f-19 fw-500 mr-2">$8.99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{url('/')}}/webassets/images/categorie-9.png">
                                </div>
                                <div class="line-product-content">
                                    <h5>Fresh Strawberry</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="text-red f-19 fw-500 mr-2">$8.99</span><span><del>$12.99</del></span>
                                    </div>
                                </div>
                            </div>
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{url('/')}}/webassets/images/cake_cream.png">
                                </div>
                                <div class="line-product-content">
                                    <h5>Fresh Strawberry</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="text-red f-19 fw-500 mr-2">$8.99</span><span><del>$12.99</del></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-lg-0 mb-4">
                        <h4 class="border-bottom-title mb-3 mb-lg-4">Herbs & Spices<span class="small-border red03"></span></h4>
                        <div class="line-products-block">
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{url('/')}}/webassets/images/rosemary.png">
                                </div>
                                <div class="line-product-content">
                                    <h5>Chocolate Cake</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="text-red f-19 fw-500 mr-2">$8.99</span><span><del>$12.99</del></span>
                                    </div>
                                </div>
                            </div>
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{url('/')}}/webassets/images/black_papper.png">
                                </div>
                                <div class="line-product-content">
                                    <h5>Fresh Strawberry</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="f-19 fw-500 mr-2">$8.99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="line-product-item d-flex align-items-center w-100 mb-3">
                                <div class="bg-white line-product-img mr-3">
                                    <img src="{{url('/')}}/webassets/images/basil_leaves.png">
                                </div>
                                <div class="line-product-content">
                                    <h5>Fresh Strawberry</h5>
                                    <div class="d-flex align-items-center ">
                                        <span class="f-19 fw-500 mr-2">$8.99</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====Products display end===-->
        <!-- =====blogs statt========== -->
        <section class="blogs-block space-6 bg-white">
            <div class="titleblock mb-5">
                <h2 class="heading-title">From the Blog </h2>
                <p class="f-16 text-grey">Etiam posuere, sem eget suscipit convallis, nibh metus molestie massa, et finibus nunc purus eget elit. Nunc non velit interdum libero rutrum auctor ut a nulla. Ut ac efficitur velit</p>
            </div>
            <div class="container">
                <div class="d-flex flex-wrap">
                    <div class="card col-lg-4 col-sm-6 mb-lg-0 mb-4 border-0 blog-item">
                        <img class="card-img-top" src="{{url('/')}}/webassets/images/Placeholder.png" alt="Card image cap">
                        <div class="card-body px-0">
                            <div class="d-flex f-14">
                                <p class="pr-2 border-right">By: John Doe</p>
                                <p class="ml-2">Sept 03, 2021</p>
                            </div>
                            <h5 class="card-title f-20">Beet & Carrot Salad Sweet Citrus Vinaigrette</h5>
                            <p class="card-text f-14">Accumsan tortor posuere ac ut consequat semper viverra nam. Posuere sollicitudin aliquam ultrices sagittis orci a. Nibh cras pulvinar mattis nunc</p>
                            <a href="" class="btn radius-50 read-butn-card f-13 mt-lg-4 mt-3 py-lg-3 py-2 px-xl-4 px-3" type="btn ">Read More <i class="fas fa-angle-double-right ml-xl-4 ml-3"></i></a>
                        </div>
                    </div>
                    <div class="card col-lg-4 col-sm-6 mb-lg-0 mb-4 border-0 blog-item">
                        <img class="card-img-top" src="{{url('/')}}/webassets/images/Placeholder-1.png" alt="Card image cap">
                        <div class="card-body px-0">
                            <div class="d-flex f-14">
                                <p class="pr-2 border-right">By: John Doe</p>
                                <p class="ml-2">Sept 03, 2021</p>
                            </div>
                            <h5 class="card-title f-20">Is your strategy hindering grocery pickup's performance?</h5>
                            <p class="card-text f-14">This card has supporting text below as a natural lead-in to additional content This card has supporting text below as a natural lead-in to additional content. This card has supporting text below as a natural lead-in to additional content</p>
                            <a href="" class="btn radius-50 read-butn-card f-13 mt-lg-4 mt-3 py-lg-3 py-2 px-xl-4 px-3" type="btn ">Read More <i class="fas fa-angle-double-right ml-xl-4 ml-3"></i></a>
                        </div>
                    </div>
                    <div class="card col-lg-4 col-sm-6 mb-lg-0 mb-4 border-0 blog-item">
                        <img class="card-img-top" src="{{url('/')}}/webassets/images/Placeholder-2.png" alt="Card image cap">
                        <div class="card-body px-0">
                            <div class="d-flex f-14">
                                <p class="pr-2 border-right">By: John Doe</p>
                                <p class="ml-2">Sept 03, 2021</p>
                            </div>
                            <h5 class="card-title f-20">Why it's time to adapt online grocery pricing strategies</h5>
                            <p class="card-text f-14">This card has supporting text below as a natural lead-in to additional content.</p>
                            <a href="" class="btn radius-50 read-butn-card f-13 mt-lg-4 mt-3 py-lg-3 py-2 px-xl-4 px-3" type="btn ">Read More <i class="fas fa-angle-double-right ml-xl-4 ml-3"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=blogs end=-->
        <section class="contact-block space-6" id="contactus">
            <div class="container">
                <div class="d-flex flex-wrap radius-50 bg-white my-xl-5 my-sm-4">
                    <div class="col-lg-6 col-md-8 px-4 py-5 pl-xl-5 contact-box">
                        <h2 class="mb-4 fw-600 color-second"><u>Contact Us</u> </h2>
                        <form action="">
                            <div class="form-row mb-4">
                                <div class="form-group  mb-0 col-md-6">
                                    <label for="">First Name </label>
                                    <input type="text " class="form-control col-md-12 text-grey" placeholder="Enter here">
                                </div>
                                <div class="form-group mb-0 col-md-6 px-0">
                                    <label for="">Last Name </label>
                                    <input type="text " class="form-control col-md-12 text-grey " placeholder="Enter here">
                                </div>
                            </div>
                            <div class="form-group mb-4 ">
                                <label for="">Email</label>
                                <input type="text" class="form-control col-md-12" placeholder="Enter here">
                            </div>
                            <div class="form-group mb-4 ">
                                <label for="">Message</label>
                                <textarea class="form-control text-grey" id="" rows="5" placeholder="Type.."></textarea>
                            </div>
                            <button class="px-5 py-3 radius-50 bg-theme text-white send-btn my-3" type="button">Send</button>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-4 store-fru px-0 overflow-hidden">
                        <img src="{{url('/')}}/webassets/images/placeholder-4.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>

        <!--====Footer=====-->


@endsection

<footer class="footer-block01 space-6 bg-white">
    <div class="container">
        <div class="row align-items-start">
            <div class=" col-xl-4 col-sm-6">
                <img src="{{url('/')}}/webassets/images/listogetlogo_transparent.png" class="footer-logo ">
                <p class="f-14 mt-2">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet</p>
            </div>
            <div class="col-xl-2  col-sm-6">
                <h4 class="footer-title mb-4 pt-2">Useful Links</h4>
                <ul class="list-unstyled footer-links">
                    <li><a class="" href="{{url('/')}}/about">About Us</a></li>
                    <li><a class="" href="{{url('/')}}/#contactus">Contact Us</a></li>
                    <li><a class="" href="{{url('/')}}/">Shops</a></li>
                    <li><a class="" href="{{url('/')}}/faq">FAQs</a></li>
                </ul>
            </div>
            <div class="col-xl-3  col-sm-6">
                <h4 class="footer-title mb-4 pt-2">Product Categories</h4>
                <ul class="list-unstyled product-list">
                    @php
                    $categoryFooter = App\Models\Category::where('status', 1)->limit(7)->get();
                    @endphp
                    @foreach ($categoryFooter as $categories)
                    
                    
                    <li><a class="" href="{{route('webshops','catid='.$categories->id)}}">{{$categories->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-xl-3  col-sm-6">
                <h4 class="footer-title mb-4 pt-2">Contact Details</h4>
                <ul class="list-unstyled contact-list mb-4">
                    <li class="mb-3 pt-2 mt-1">
                        <a class="d-flex align-items-center justify-content-between text-decoration-none" href="">
                           <span class="contact-icon"> <img src="{{url('/')}}/webassets/images/map.png" class=""></span>
                           <span class="contact-text">350 Bay Meadows St. Reynoldsburg, OH 43068</span>
                        </a>
                    </li>
                     <li class="mb-3">
                        <a class="d-flex align-items-center justify-content-between text-decoration-none" href="tel:+1-202-555-0168">
                           <span class="contact-icon"> <img src="{{url('/')}}/webassets/images/phone.png" class=""></span>
                           <span class="contact-text "><p class="f-14 text-secondary mb-1">Mon - Fri: 9:00 am - 9:00 pm</p><span class="f-17">+1-202-555-0168</span></span>
                        </a>
                    </li>
                </ul>
                <ul class="list-unstyled d-flex social-list pt-2">
                    <li><a href=""><img src="{{url('/')}}/webassets/images/facebook.png"></a></li>
                    <li><a href=""><img src="{{url('/')}}/webassets/images/instagram.png"></a></li>
                    <li><a href=""><img src="{{url('/')}}/webassets/images/twitter.png"></a></li>
                    <li><a href=""><img src="{{url('/')}}/webassets/images/linkedin.png"></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--===Footer===-->
<!-- scripts -->
<script type="" src="{{url('/')}}/webassets/js/jquery.js"> </script>
<script type="" src="{{url('/')}}/webassets/js/popper.min.js"> </script>
<script type="" src="{{url('/')}}/webassets/js/bootstrap.min.js"></script>
<script type="" src="{{url('/')}}/webassets/js/owl.carousel.min.js"> </script>
<script type="" src="{{url('/')}}/webassets/js/nice-select.js"> </script>
<script src="{{url('/')}}/webassets/js/main.js"></script>
<script>
$("document").ready(function(){
    setTimeout(function(){
        $(".msgrm").remove();
    }, 3000 );

});
</script>

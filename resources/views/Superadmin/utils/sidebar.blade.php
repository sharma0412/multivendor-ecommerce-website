{{-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> --}}
<link rel="stylesheet" href="{{url('/')}}/assets/css/style.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


<!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">

                            <li class="">
                                <a href="{{route('home')}}" class="waves-effect border-redious-li d-flex px-3">
                                <i class="fa fa-tachometer main-ico" aria-hidden="true"></i>
                                    <span>Dashboards</span>
                                </a>

                            </li>
                            @if(Auth::User()->role == 0)
                            {{-- <li class="{{ Request::segment(1) == 'staff' ? 'mm-active' : ''}}">
                                <a href="{{route('stafflist')}}" class="waves-effect border-redious-li d-flex px-3 {{ Request::segment(1) == 'staff' ? 'active' : ''}}">
                                <i class="fas fa-th-large main-ico"></i>
                                    <span>Staff</span>
                                </a>

                            </li> --}}
                            <li class="{{ Request::segment(1) == 'category' ? 'mm-active' : ''}}">
                                <a href="{{route('categorylist')}}" class="waves-effect border-redious-li d-flex px-3 {{ Request::segment(1) == 'category' ? 'active' : ''}}">
                                <i class="fas fa-th-large main-ico"></i>
                                    <span>Category</span>
                                </a>

                            </li>
                            <li class="{{ Request::segment(1) == 'vendors' ? 'mm-active' : ''}}">
                                <a href="{{route('vendorlist')}}" class="waves-effect border-redious-li d-flex px-3 {{ Request::segment(1) == 'vendors' ? 'active' : ''}}
                                ">
                                <i class="fas fa-th-large main-ico"></i>
                                    <span>Store</span>
                                </a>

                            </li>
                            <li class="{{ Request::segment(1) == 'customer' ? 'mm-active' : ''}}">
                                <a href="{{route('customerlist')}}" class="waves-effect border-redious-li d-flex px-3 {{ Request::segment(1) == 'customer' ? 'active' : ''}}">
                                <i class="fas fa-th-large main-ico"></i>
                                    <span>Customer</span>
                                </a>

                            </li>
                            <li class="{{ Request::segment(1) == 'banner' ? 'mm-active' : ''}}">
                                <a href="{{route('bannerlist')}}" class="waves-effect border-redious-li d-flex px-3 {{ Request::segment(1) == 'banner' ? 'active' : ''}}">
                                <i class="fas fa-th-large main-ico"></i>
                                    <span>Banner</span>
                                </a>

                            </li>

                            <li class="{{ Request::segment(1) == 'product' ? 'mm-active' : ''}}">
                                <a href="{{route('productlist')}}" class="waves-effect border-redious-li d-flex px-3 {{ Request::segment(1) == 'product' ? 'active' : ''}}">
                                <i class="fas fa-th-large main-ico"></i>
                                    <span>Product</span>
                                </a>
                            </li>
                            <li class="{{ Request::segment(1) == 'units' ? 'mm-active' : ''}}">
                                <a href="{{route('unitslist')}}" class="waves-effect border-redious-li d-flex px-3 {{ Request::segment(1) == 'units' ? 'active' : ''}}">
                                <i class="fas fa-th-large main-ico"></i>
                                    <span>Units</span>
                                </a>
                            </li>
                            @endif
                             <li class="{{ Request::segment(1) == 'order' ? 'mm-active' : ''}}">
                                <a href="{{route('orderlist')}}" class="waves-effect border-redious-li d-flex px-3 {{ Request::segment(1) == 'order' ? 'active' : ''}}">
                                <i class="fas fa-th-large main-ico"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
                            @if(Auth::User()->role == 1)
                            <li class="{{ Request::segment(1) == 'venderproduct' ? 'mm-active' : ''}}">
                                <a href="{{route('venderproduct')}}" class="waves-effect border-redious-li d-flex px-3 {{ Request::segment(1) == 'venderproduct' ? 'active' : ''}}">
                                <i class="fas fa-th-large main-ico"></i>
                                    <span>Product</span>
                                </a>
                            </li>

                            @endif
                            @if(Auth::User()->role == 0)
                            <li class="{{ Request::segment(1) == 'MyListCategory' ? 'mm-active' : ''}}">
                                <a href="{{route('MyListCategorylist')}}" class="waves-effect border-redious-li d-flex px-3 {{ Request::segment(1) == 'MyListCategory' ? 'active' : ''}}">
                                <i class="fas fa-th-large main-ico"></i>
                                    <span>MyListCategory</span>
                                </a>

                            </li>
                            <li class="{{ Request::segment(1) == 'notification' ? 'mm-active' : ''}}">
                                <a href="{{route('notification')}}" class="waves-effect border-redious-li d-flex px-3 {{ Request::segment(1) == 'notification' ? 'active' : ''}}">
                                <i class="fas fa-th-large main-ico"></i>
                                    <span>Notification</span>
                                </a>

                            </li>
                            @endif
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

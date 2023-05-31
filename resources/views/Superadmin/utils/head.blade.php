<style>
    .navbar-brand-box{padding:0px}
</style>
<header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{env('APP_LOGO')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{env('APP_LOGO')}}" alt="">
                                </span>
                            </a>

                            <a href="/" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{env('APP_LOGO')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{env('APP_LOGO')}}" alt="" height="50">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-menu"></i>
                        </button>



                    </div>


                    <div class="d-flex">


                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{auth::user()->profile}}"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ml-1"></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a class="dropdown-item" href="{{route('profile')}}"><i class="dripicons-user d-inlne-block text-muted mr-2"></i> Profile</a>

                                <a class="dropdown-item" href="{{route('logout')}}"><i class="dripicons-exit d-inlne-block text-muted mr-2"></i> Logout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

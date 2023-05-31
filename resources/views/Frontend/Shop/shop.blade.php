@extends('Frontend.utils.master')

@section('content')
<div class="page-content">
    <div class="breadcrumb-div bg-theme">
        <div class="container">
            <ul class="breadcrumb-custom mb-0 bg-none">
                <li><a href="{{route('webhome')}}" >Home</a></li>
                <li class="on">Shops</li>
            </ul>
        </div>
    </div>
    <section class="stores-block space-6">
        <div class="container">
            <div class="mb-5 d-md-flex justify-content-between align-items-center">
                 <h3 class="heading-other mb-md-0 mb-4 pr-md-4">{{$catDetails->name ?? ''}}</h3>
                 <!-- <div class="inner-search-block ">
                    <img src="webassets/images/dark-search.png" class="inner-search-icon">
                    <input class="inner-search-input" placeholder="Search for product…" type="Search">
                </div> -->
            </div>
            <div class="row">
                @if($user->count() > 0)
                @foreach ($user as $users)
                <div class="col-lg-4 col-sm-6 mb-5 px-md-3 px-sm-2 px-3">
                    <a href="{{route('webshopdetails',$users->id)}}" class="shop-item text-decoration-none">
                        <img src="{{$users->profile}}" class="shop-img">
                        <div class="shop-bottom bg-white overflow-hidden">
                            <h4 class="shop-title one-line">{{$users->username}}</h4>
                            <div class="d-flex align-items-end overflow-hidden shop--name">
                                <img src="webassets/images/location.png" class="small-icon mr-1">
                                <span class="f-14 text-grey one-line">{{$users->address}}</span>
                            </div>
                            <div class="store-rating d-flex ">
                                <img src="webassets/images/star.png" class="mr-1">
                                <p class="f-15 mb-0 text-grey">4.0</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @else
                <h3>Shops are not available in current location!</h3>
                @endif
            </div>
        </div>
    </section>
    <div class="laravel-pagination-div">
    </div>
</div>
    @endsection

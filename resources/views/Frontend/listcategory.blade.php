@extends('Frontend.utils.master')

@section('content')
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
               
            </div>
        </section>
@endsection

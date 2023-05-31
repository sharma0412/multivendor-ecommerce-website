@if ($data->count()>0) 
    <ul class="list-unstyled listing-serch border px-4 py-2">
    @foreach ($data as $row)
       <a class="text-decoration-none" href="{{route('webshopdetails',$row['id'])}}"><li class="d-flex"><span><img src="{{$row['profile']}}" class="rounded serch-under-img"></span> <p class="ml-3">{{$row['username']}}</p></li></a>
    @endforeach
    </ul>
    @else 
        <li class="d-flex"> <p class="ml-3">No Result Found!</p></li>
    @endif        
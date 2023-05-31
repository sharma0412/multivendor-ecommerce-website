
@extends('Superadmin.utils.master')

@section('content')


<div class="main-content">
	<div class="page-content">
		<div class="container-fluid">
			<div class="row">

					@if(Auth::User()->role == 0)
				<div class="col-lg-3 ">
				
					<a href="{{route('stafflist')}}" class="card rounded text-center">
						<h3 class="card-header   font-weight-boldh3 text-white " style="background: LightPink ;" >Staff</h3>
						<div class="card-body fo font-weight-bold ">{{$staff}}</div>
					</a>
				</div>
				<div class="col-lg-3 ">
					<a href="{{route('categorylist')}}" class="card rounded text-center">
						<h3 class="card-header   font-weight-boldh3 text-white "style="background: SlateBlue  ;">Category</h3>
						<div class="card-body font-weight-bold ">{{$Category}}</div>
					</a>
				</div>
				<div class="col-lg-3 ">
					<a href="{{route('vendorlist')}}" class="card rounded text-center">
						<h3 class="card-header   font-weight-boldh3 text-white "style="background: Salmon  ;">Vender</h3>
						<div class="card-body font-weight-bold ">{{$Vender}}</div>
					</a>
				</div>
				<div class="col-lg-3 ">
					<a href="{{route('customerlist')}}" class="card rounded text-center">
						<h3 class="card-header   font-weight-boldh3 text-white "style="background: DarkOrange  ;">Customer</h3>
						<div class="card-body font-weight-bold ">{{$Customer}}</div>
					</a>
				</div>
				<div class="col-lg-3 ">
					<a href="{{route('bannerlist')}}" class="card rounded text-center">
						<h3 class="card-header   font-weight-boldh3 text-white "style="background: LawnGreen  ;">Banner</h3>
						<div class="card-body font-weight-bold ">{{$Banner}}</div>
					</a>
				</div>
				@endif
				<div class="col-lg-3 ">
				
					<a href="{{route('stafflist')}}" class="card rounded text-center">
						<h3 class="card-header   font-weight-boldh3 text-white " style="background: LightPink ;" >Product</h3>
						<div class="card-body fo font-weight-bold ">{{$product}}</div>
					</a>
				</div>
				<div class="col-lg-3 ">
					<a href="{{route('orderlist')}}" class="card rounded text-center">
						<h3 class="card-header   font-weight-boldh3 text-white "style="background: Cyan   ;">Order</h3>
						<div class="card-body font-weight-bold ">{{$Order}}</div>
					</a>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection

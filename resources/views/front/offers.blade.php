@extends('front/layout')
@section('home_active','')
@section('page_title','Offers Section | Get Best Offers only for You ')
@section('container')
<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Offers</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="all-product-grid mb-14">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="default-title mt-4">
							<h2>Offers</h2>
							<img src="{{asset('front_assets/images/line.svg')}}" alt="">
						</div>
					</div>
					@foreach($offer as $offer)
					<div class="col-lg-4">
						<a href="{{url('/offers/'.$offer->slug)}}" class="offers-item">
							<div class="offer-img">
								<img src="{{asset('storage/offers/'.$offer->img)}}" alt="">
							</div>
							<div class="offers-text">
								<h4>📢  {{$offer->tagline}}!</h4>
								<p>Up to 25% off on Vegetables & Fruits & much more</p>
							</div>
						</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>	
	</div>
<!-- Body End -->
@endsection
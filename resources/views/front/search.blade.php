@extends('front/layout')
@section('featured_active','')
@section('page_title','Welcome To Grockart')
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
								<li class="breadcrumb-item text-capitalize active" aria-current="page">Search</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="all-product-grid">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="product-top-dt">
							<div class="product-left-title">
								<h2 class="text-capitalize">Search Result</h2>
							</div>
							<!-- <a href="#" class="filter-btn pull-bs-canvas-right">Filters</a> -->
							@if(count($product)!=0)
							<div class="product-sort float-left float-md-right">
								<div class="ui selection dropdown vchrt-dropdown">
									<input name="gender" type="hidden" value="default">
									<i class="dropdown icon d-icon"></i>
									<div class="text">Popularity</div>
									<div class="menu">
										<div class="item" onclick="sort_by('popularity')" data-value="0">Popularity</div>
										<div class="item" onclick="sort_by('price_high')" data-value="1">Price - Low to High</div>
										<div class="item" onclick="sort_by('price_low')" data-value="2">Price - High to Low</div>
										<div class="item" onclick="sort_by('name')" data-value="3">Alphabetical</div>
										<div class="item" onclick="sort_by('date')" data-value="4">Date</div>
									</div>
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>
				<div class="product-list-view">
					<div class="row showRow">
						@if(count($product)!=0)
						@foreach($product as $product)
						<div class="col-lg-3 col-md-6">
							<div class="product-item mb-30">
								<a href="{{url('products/'.$product->slug)}}" class="product-img">
									<img src="{{asset('/storage/ProductsImage/'.$product->image1)}}" alt="">
									<div class="product-absolute-options">
										<span class="offer-badge-1">6% off</span>
										<span class="like-icon" title="wishlist"></span>
									</div>
								</a>
								<div class="product-text-dt">
									<p>Available<span>(In Stock)</span></p>
									<h4>{{$product->name}}</h4>
									<div class="product-price">₹{{$product->price}} <span>₹{{$product->mrp}}</span></div>
									<div class="qty-cart">
										<div class="quantity buttons_added">
											<input type="button" value="-" class="minus minus-btn">
											@php $rand=rand(111,999); @endphp
											<input type="number" step="1" name="quantity" value="1" id="Qty{{$product->slug}}{{$product->product_id}}{{$rand}}" class="input-text qty text">
											<input type="button" value="+" class="plus plus-btn">
										</div>
										<span class="cart-icon"><i class="uil uil-shopping-cart-alt" onclick="AddToCartCarousel('{{$product->product_id}}', '{{$product->slug}}', '{{$rand}}')"></i></span>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						<div class="col-md-12">
							<div class="more-product-btn">
								<button class="show-more-btn hover-btn" onclick="window.location.href = '#';">Show More</button>
							</div>
						</div>
						@else
						<h5 class="ml-md-5 ml-4">No Result Found</h5>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Body End -->
	<!-- add to cart form -->
	<form id="frmSort">
		<input type="hidden" id="sort_by" name="sort">
		<!-- <input type="text" id="category_filter" name="category_filter[]"> -->
		<!-- @csrf -->
	</form>
	<style type="text/css">
		.pagination{
		    justify-content: center;
		}
		li.page-item.disabled, .page-link{
		    /*border: 1px solid #f55d2c;*/
		    color: #f55d2c !important;
		    background: #fff !important;
		}
		li.page-item.active .page-link{
		    border: 1px solid #f55d2c !important;
		    color: #fff !important;
		    background: #f55d2c !important;
		}
	</style>
@endsection
@extends('front/layout')
@section('featured_active','active')
@section('page_title','Grockart | Shop From Our Wide Featured Section')
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
								<li class="breadcrumb-item text-capitalize active" aria-current="page">featured products</li>
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
								<h2 class="text-capitalize">Featured Products</h2>
							</div>
							<!-- <a href="#" class="filter-btn pull-bs-canvas-right">Filters</a> -->
							<div class="product-sort float-left float-md-right">
								<div class="ui selection dropdown vchrt-dropdown">
									<input name="gender" type="hidden" value="default">
									<i class="dropdown icon d-icon"></i>
									@php
									if($sort!=''){
										if($sort=='/popularity'){
											$tempsort='By Popularity';
										}
										elseif($sort=='/price_high'){
											$tempsort='By Price Low To High';
										}
										elseif($sort=='/price_low'){
											$tempsort='By Price High To Low';
										}
										elseif($sort=='/name'){
											$tempsort='By Name';
										}
										else{
											$tempsort='By Date';
										}
									}else{
										$tempsort='Popularity';
									}
									@endphp
									<div class="text">{{$tempsort}}</div>
									<div class="menu">
										<div class="item" onclick="item_sort('popularity','{{$sort}}','featured-products','{{$page}}')" data-value="0">Popularity</div>
										<div class="item" onclick="item_sort('price_high','{{$sort}}','featured-products','{{$page}}')" data-value="1">Price - Low to High</div>
										<div class="item" onclick="item_sort('price_low','{{$sort}}','featured-products','{{$page}}')" data-value="2">Price - High to Low</div>
										<div class="item" onclick="item_sort('name','{{$sort}}','featured-products','{{$page}}')" data-value="3">Alphabetical</div>
										<div class="item" onclick="item_sort('date','{{$sort}}','featured-products','{{$page}}')" data-value="4">Date</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="product-list-view">
					<div class="row showRow">
						@foreach($product as $products)
						<div class="col-lg-3 col-md-6">
							<div class="product-item mb-30">
								<a href="{{url('products/'.$products->slug)}}" class="product-img">
									<img src="{{asset('/storage/ProductsImage/'.$products->image1)}}" alt="">
									<div class="product-absolute-options">
										<span class="offer-badge-1">{{$products->discount}}% off</span>
										<span class="like-icon" onclick="AddToWishlist('{{$products->product_id}}')" title="wishlist"></span>
									</div>
								</a>
								<div class="product-text-dt">
									<p>Available<span>(In Stock)</span></p>
									<h4>{{$products->name}}</h4>
									<div class="product-price">₹{{$products->price}} <span>₹{{$products->mrp}}</span></div>
									<div class="qty-cart">
										<div class="quantity buttons_added">
											<input type="button" value="-" class="minus minus-btn">
											@php $rand=rand(111,999); @endphp
											<input type="number" step="1" name="quantity" value="1" id="Qty{{$products->slug}}{{$products->product_id}}{{$rand}}" class="input-text qty text">
											<input type="button" value="+" class="plus plus-btn">
										</div>
										<span class="cart-icon"><i class="uil uil-shopping-cart-alt" onclick="AddToCartCarousel('{{$products->product_id}}', '{{$products->slug}}', '{{$rand}}')"></i></span>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						@if($product->count()==0) <script type="text/javascript">window.location.href='/featured-products';</script> @endif
						<div class="col-md-12">
							<div class="more-product-btn">
								{{$product->links('pagination::bootstrap-4')}}
							</div>
						</div>
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
		    transition: 0.5s ease all;
		}

		.page-link:focus {
		    outline: none !important;
		    box-shadow: none !important;
		    border-color: 1px solid #fff;
		    /*border: 1px solid #f55d2c !important;*/
		}
		 
		.page-link:hover, li.page-item.active:hover{
		    color: #fff !important;
		    background: #f55d2c !important;
		    text-decoration: none;
		    border-left: 2px solid #fff !important;
		    border-right: 2px solid #fff !important;
		}
	</style>
@endsection
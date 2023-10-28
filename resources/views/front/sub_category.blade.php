@extends('front/layout')
@section('home_active','')
@section('page_title', 'Get choose from '.$currentCategories[0]->category_name)
@section('container')
	<!-- Filter Right Sidebar Offset Start-->
	<div class="bs-canvas bs-canvas-right position-fixed bg-cart h-100">
		<div class="bs-canvas-header side-cart-header p-3 ">
			<div class="d-inline-block  main-cart-title">Filters</div>
			<button type="button" class="bs-canvas-close close" aria-label="Close"><i class="uil uil-multiply"></i></button>
		</div> 
		<div class="bs-canvas-body filter-body">
			<div class="filter-items">
				<div class="filtr-cate-title">
					<h4>By Categories</h4>
				</div>
				<div class="other-item-body scrollstyle_4">
					<div class="brand-list">
	                    @foreach($categories as $list1)
						<div class="custom-control custom-checkbox pb2">
							<input type="checkbox" value="{{$list1->id}}" name="categoryfilter" class="custom-control-input" id="cat{{$list1->id}}">
							<label class="custom-control-label" for="cat{{$list1->id}}">{{$list1->category_name}}</label>
						</div>
	                    @endforeach
					</div>
				</div>
			</div>
			<div class="filter-items">
				<div class="filtr-cate-title">
					<h4>By Sub Categories</h4>
				</div>
				<div class="price-pack-item-body scrollstyle_4">
					<div class="brand-list">
	                    @foreach($sub_categories as $list2)
						<div class="custom-control custom-checkbox pb2">
							<input type="checkbox" value="{{$list2->id}}" name="subcategoryfilter" class="custom-control-input" id="subcat{{$list2->id}}">
							<label class="custom-control-label" for="subcat{{$list2->id}}">{{$list2->subcategory_name}}</label>
						</div>
	                    @endforeach
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="more-product-btn">
					<button class="show-more-btn hover-btn" onclick="applyFilter('{{url()->current()}}')">Apply</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Filter Right Sidebar Offsetl End-->
	<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item text-capitalize active" aria-current="page">{{$currentCategories[0]->category_name}}</li>
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
								<h2 class="text-capitalize">{{$currentCategories[0]->category_name}}</h2>
							</div>
							<a href="#" class="filter-btn pull-bs-canvas-right">Filters</a>
							<div class="product-sort">
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
						</div>
					</div>
				</div>
				<div class="product-list-view">
					<div class="row showRow">
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
	<input type="hidden" id="category_filter" value="">
	<input type="hidden" id="subcategory_filter" value="">
	<!-- <input type="hidden" id="category_filter" value=""> -->
	<!-- add to cart form -->	
@endsection
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
						@if(isset($selected_categories))
	                    	@foreach($selected_categories as $list1)
	                    	<div class="custom-control custom-checkbox pb2">
								<input type="checkbox" checked="" value="{{$list1->category_slug}}" name="categoryfilter" class="custom-control-input" id="cat{{$list1->id}}">
								<label class="custom-control-label text-capitalize" for="cat{{$list1->id}}">{{$list1->category_name}}</label>
							</div>
		                    @endforeach
		                    @foreach($remainig_categories as $list12)
	                    	<div class="custom-control custom-checkbox pb2">
								<input type="checkbox" value="{{$list12->category_slug}}" name="categoryfilter" class="custom-control-input" id="cat{{$list12->id}}">
								<label class="custom-control-label text-capitalize" for="cat{{$list12->id}}">{{$list12->category_name}}</label>
							</div>
		                    @endforeach
	                    @else
		                    @foreach($categories as $list1)
							<div class="custom-control custom-checkbox pb2">
								<input type="checkbox" value="{{$list1->category_slug}}" name="categoryfilter" class="custom-control-input" id="cat{{$list1->id}}">
								<label class="custom-control-label text-capitalize" for="cat{{$list1->id}}">{{$list1->category_name}}</label>
							</div>
		                    @endforeach
	                    @endif
					</div>
				</div>
			</div>
			<div class="filter-items">
				<div class="filtr-cate-title">
					<h4>By Sub Categories</h4>
				</div>
				<div class="price-pack-item-body scrollstyle_4">
					<div class="brand-list">
	                    @if(isset($selected_sub_categories))
	                    	@foreach($selected_sub_categories as $list1112)
	                    	<div class="custom-control custom-checkbox pb2">
								<input type="checkbox" checked="" value="{{$list1112->subcategory_slug}}" name="subcategoryfilter" class="custom-control-input" id="subcat{{$list1112->id}}">
								<label class="custom-control-label text-capitalize" for="subcat{{$list1112->id}}">{{$list1112->subcategory_name}}</label>
							</div>
		                    @endforeach
		                    @foreach($remainig_sub_categories as $list1221)
	                    	<div class="custom-control custom-checkbox pb2">
								<input type="checkbox" value="{{$list1221->subcategory_slug}}" name="subcategoryfilter" class="custom-control-input" id="subcat{{$list1221->id}}">
								<label class="custom-control-label text-capitalize" for="subcat{{$list1221->id}}">{{$list1221->subcategory_name}}</label>
							</div>
		                    @endforeach
	                    @else
		                    @foreach($subcategories as $list1112)
							<div class="custom-control custom-checkbox pb2">
								<input type="checkbox" value="{{$list1112->subcategory_slug}}" name="subcategoryfilter" class="custom-control-input" id="subcat{{$list1112->id}}">
								<label class="custom-control-label text-capitalize" for="subcat{{$list1112->id}}">{{$list1112->subcategory_name}}</label>
							</div>
		                    @endforeach
	                    @endif
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="more-product-btn">
					@php if(isset($_GET['from'])){ $from = 'all'; }else{ $from=''; } @endphp
					<button class="show-more-btn hover-btn" onclick="applyFilter('categories/{{$currentCategories[0]->category_slug}}','{{$page}}','{{$urlcategory}}','{{$urlsubcategory}}','{{$urlcategoryslug}}','{{$currentCategories[0]->category_slug}}','{{$from}}')">Apply</button>
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
								@if(isset($_GET['subcategory']) || isset($_GET['category']))
								@php $subcat_name = explode(',', $_GET['subcategory']);  @endphp
								@php $urlcat_name = explode(',', $_GET['category']);  @endphp
								@if(isset($_GET['from']) && count($subcat_name)==1 && $_GET['subcategory']!='null')
								<h2 class="text-capitalize">{{$_GET['subcategory']}}</h2>
								@elseif(isset($_GET['from']) && count($subcat_name)>1)
								<h2 class="text-capitalize">Products Found</h2>

								@elseif(isset($_GET['from']) && count($urlcat_name)==1  && $_GET['category']!='null')
								<h2 class="text-capitalize">{{$_GET['category']}}</h2>
								@elseif(isset($_GET['from']) && count($urlcat_name)>1)
								<h2 class="text-capitalize">Products Found</h2>
								@else
								<h2 class="text-capitalize">{{$currentCategories[0]->category_name}}</h2>
								@endif
								@else
								<h2 class="text-capitalize">{{$currentCategories[0]->category_name}}</h2>
								@endif
							</div>
							<a href="javascript::void()" class="filter-btn pull-bs-canvas-right">Filters</a>
							<div class="product-sort">
								<div class="ui selection dropdown vchrt-dropdown">
									<input name="gender" type="hidden" value="default">
									<i class="dropdown icon d-icon"></i>
									@php
									if($sort=='null'){
										$tempsort='Popularity';
									}
									else{
										if($sort=='date'){
											$tempsort='By Date';
										}
										elseif($sort=='price_high'){
											$tempsort='By Price Low To High';
										}
										elseif($sort=='price_low'){
											$tempsort='By Price High To Low';
										}
										elseif($sort=='name'){
											$tempsort='By Name';
										}
										else{
											$tempsort='By Popularity';
										}
									}
									@endphp
									<div class="text">{{$tempsort}}</div>
									<div class="menu">
										@php if(isset($_GET['from'])){ $from = $_GET['from']; } else { $from = ''; } @endphp
										<div class="item" onclick="item_sort_category_page('popularity','categories/{{$currentCategories[0]->category_slug}}','{{$page}}','{{$urlcategoryslug}}','{{$urlsubcategory}}','{{$from}}')" data-value="0">Popularity</div>
										<div class="item" onclick="item_sort_category_page('price_high','categories/{{$currentCategories[0]->category_slug}}','{{$page}}','{{$urlcategoryslug}}','{{$urlsubcategory}}','{{$from}}')" data-value="1">Price - Low to High</div>
										<div class="item" onclick="item_sort_category_page('price_low','categories/{{$currentCategories[0]->category_slug}}','{{$page}}','{{$urlcategoryslug}}','{{$urlsubcategory}}','{{$from}}')" data-value="2">Price - High to Low</div>
										<div class="item" onclick="item_sort_category_page('name','categories/{{$currentCategories[0]->category_slug}}','{{$page}}','{{$urlcategoryslug}}','{{$urlsubcategory}}','{{$from}}')" data-value="3">Alphabetical</div>
										<div class="item" onclick="item_sort_category_page('date','categories/{{$currentCategories[0]->category_slug}}','{{$page}}','{{$urlcategoryslug}}','{{$urlsubcategory}}','{{$from}}')" data-value="4">Date</div>
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
		<!-- <input type="text" id="category" name="category[]"> -->
		<!-- @csrf -->
	</form>
	<input type="hidden" id="category" value="">
	<input type="hidden" id="subcategory" value="">
	<!-- <input type="hidden" id="category" value=""> -->
	<!-- add to cart form -->	
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
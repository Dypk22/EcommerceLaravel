<!DOCTYPE html>
<html lang="en">

	
<!-- Mirrored from gambolthemes.net/html-items/gambo_supermarket_demo/index by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 26 May 2020 11:38:58 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">		
    <title>@yield('page_title')</title>
	
	<!-- Favicon Icon -->
	<link rel="icon" type="image/png" href="{{asset('front_assets/images/fav.png')}}">
	
	<!-- Stylesheets -->
	<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
	<link href="{{asset('front_assets/vendor/unicons-2.0.1/css/unicons.css')}}" rel='stylesheet'>
	<link href="{{asset('front_assets/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('front_assets/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('front_assets/css/night-mode.css')}}" rel="stylesheet">
	<link href="{{asset('front_assets/css/step-wizard.css')}}" rel="stylesheet">
	
	<!-- Vendor Stylesheets -->
	<link href="{{asset('front_assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
	<link href="{{asset('front_assets/vendor/OwlCarousel/assets/owl.carousel.css')}}" rel="stylesheet">
	<link href="{{asset('front_assets/vendor/OwlCarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
	<link href="{{asset('front_assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('front_assets/vendor/semantic/semantic.min.css')}}">	
	<script type="text/javascript">var PRODUCT_IMAGE="{{asset('storage/ProductsImage/')}}";</script>
	<script type="text/javascript">var NORMAL_IMAGE="{{asset('storage/')}}";</script>
	<script type="text/javascript">var PATH="{{url('/')}}";</script>
	<script src="{{asset('front_assets/js/jquery-3.3.1.min.js')}}"></script>

</head>
<body>
	<!-- Category Model Start-->
	<div id="category_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
        <div class="modal-dialog category-area" role="document">
            <div class="category-area-inner">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
						<i class="uil uil-multiply"></i>
                    </button>
                </div>
                <div class="category-model-content modal-content"> 
					<div class="cate-header">
						<h4>Select Category</h4>
					</div>
                    <ul class="category-by-cat">
	                    @foreach($categories as $list1)
						<li>
							<a href="{{url('categories/'.$list1->category_slug)}}" class="single-cat-item">
								<div class="icon">
									<img src="{{asset('front_assets/images/category')}}/icon-{{$list1->id}}.svg" alt="">
								</div>
								<div class="text text-capitalize">{{$list1->category_name}}</div>
							</a>
						</li>
						@endforeach
                    </ul>
						<a href="{{url('all-categories')}}" class="morecate-btn"><i class="uil uil-apps"></i>More Categories</a>
                </div>
            </div>
        </div>
    </div>
	<!-- Category Model End-->	
	<!-- Search Model Start-->
	<div id="search_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
        <div class="modal-dialog search-ground-area" role="document">
            <div class="category-area-inner">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
						<i class="uil uil-multiply"></i>
                    </button>
                </div>
                <div class="category-model-content modal-content"> 
					<div class="search-header">
						<form action="#">
							<input type="search" placeholder="Search for products...">
							<button type="submit"><i class="uil uil-search"></i></button>
						</form>
					</div>
					<div class="search-by-cat">
                        <a href="#" class="single-cat">
                            <div class="icon">
								<img src="{{asset('front_assets/images/category/icon-1.svg')}}" alt="">
                            </div>
                            <div class="text">
                                Fruits and Vegetables
                            </div>
                        </a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="{{asset('front_assets/images/category/icon-2.svg')}}" alt="">
							</div>
							<div class="text"> Grocery & Staples </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="{{asset('front_assets/images/category/icon-3.svg')}}" alt="">
							</div>
							<div class="text"> Dairy & Eggs </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="{{asset('front_assets/images/category/icon-4.svg')}}" alt="">
							</div>
							<div class="text"> Beverages </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="{{asset('front_assets/images/category/icon-5.svg')}}" alt="">
							</div>
							<div class="text"> Snacks </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="{{asset('front_assets/images/category/icon-6.svg')}}" alt="">
							</div>
							<div class="text"> Home Care </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="{{asset('front_assets/images/category/icon-7.svg')}}" alt="">
							</div>
							<div class="text"> Noodles & Sauces </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="{{asset('front_assets/images/category/icon-8.svg')}}" alt="">
							</div>
							<div class="text"> Personal Care </div>
						</a>
						<a href="#" class="single-cat">
							<div class="icon">
								<img src="{{asset('front_assets/images/category/icon-9.svg')}}" alt="">
							</div>
							<div class="text"> Pet Care </div>
						</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Search Model End-->
	@php
	$getAddToCartTotalItem=getAddToCartTotalItem();
	$totalCartItem=count($getAddToCartTotalItem);
	$totalPrice=0;
	$totalMRP=0;
	$totalSaving=0;
	$rand_num=rand(1,9);
	@endphp 	
	<!-- Cart Sidebar Offset Start-->
	<div class="bs-canvas bs-canvas-left position-fixed bg-cart h-100">
		<div class="bs-canvas-header side-cart-header p-3 ">
			<div class="d-inline-block  main-cart-title">My Cart <span>(<span class="cart_number ml-0">{{$totalCartItem}}</span> Items)</span></div>
			<button type="button" class="bs-canvas-close close" aria-label="Close"><i class="uil uil-multiply"></i></button>
		</div> 
		<div class="bs-canvas-body">
			<div class="cart-top-total">
				<div class="cart-total-dil">
					<h4>Gambo Super Market</h4>
					@php
	                $initial=0;
	                @endphp
					@foreach($getAddToCartTotalItem as $only)
	                @php
	                $initial+=($only->qty*$only->mrp);
	                @endphp
	                @endforeach
					<span class="totalMRP">₹{{$initial}}</span>
				</div>
				<div class="cart-total-dil pt-2">
					<h4>Delivery Charges</h4>
					<span>Free <del>₹49</del></span>
				</div>
			</div>
			@if($totalCartItem==0)
			<div class="py-md-5 py-0 px-3 side-cart-items">
				<div class="about-img">
					<img src="{{asset('front_assets/images/about.svg')}}" alt="">
				</div>
				<center style="margin-top: 20px;font-weight: 500;"><h4>Start Shopping!</h4></center>
			</div>
			@else
			<div class="side-cart-items">
				@foreach($getAddToCartTotalItem as $cartItem)
                @php
                $totalPrice=$totalPrice+($cartItem->qty*$cartItem->price);
                $totalMRP=$totalMRP+($cartItem->qty*$cartItem->mrp);
                $totalSaving = $totalMRP - $totalPrice;
                @endphp
				<div class="cart-item">
					<div class="cart-product-img">
						<img src="{{asset('storage/ProductsImage/'.$cartItem->image1)}}" alt="">
						<!-- <div class="offer-badge">6% OFF</div> -->
					</div>
					<div class="cart-text">
						<h4 class="text-capitalize">{{$cartItem->name}}</h4>
						<div class="cart-radio">
							<ul class="kggrm-now">
								<li>
									<!-- <input type="radio" id="a1" name="cart1"> -->
									<label>{{$cartItem->weight}}</label>
								</li>
								<!-- <li>
									<input type="radio" id="a2" name="cart1">
									<label for="a2">1kg</label>
								</li> -->
								<!-- <li>
									<input type="radio" id="a3" name="cart1">
									<label for="a3">2kg</label>
								</li>
								<li>
									<input type="radio" id="a4" name="cart1">
									<label for="a4">3kg</label>
								</li> -->
							</ul>
						</div>
						<div class="qty-group">
							<div class="quantity buttons_added">
								<input type="button" value="-" class="minus minus-btn">
								<input type="number" step="1" name="quantity" onchange="upadateQty('{{$rand_num}}', '{{$cartItem->pid}}')" value="{{$cartItem->qty}}" class="input-text Qty_{{$rand_num}}{{$cartItem->pid}} qty text">
								<input type="button" value="+" class="plus plus-btn">
							</div>
							<div class="cart-item-price">₹{{$cartItem->price}} <span>₹{{$cartItem->mrp}}</span></div>
						</div>
						
						<button type="button" class="cart-close-btn" onclick="deleteCartProduct('{{$cartItem->pid}}')";><i class="uil uil-multiply"></i></button>
					</div>
				</div>
                @endforeach
			</div>
			@endif
		</div>
		<div class="bs-canvas-footer">
			<div class="cart-total-dil saving-total ">
				<h4>Total Saving</h4>
				<span class="totalSaving">₹{{$totalSaving}}</span>
			</div>
			<div class="main-total-cart">
				<h2>Total</h2>
				<span class="totalPrice">₹{{$totalPrice}}</span>
			</div>
			@php $alias='';
			if($totalCartItem==0){$alias='d-none';} 
			@endphp 
			<div class="checkout-cart {{$alias}}" id="checkoutBtn">
				<!-- <a href="#" class="promo-code">Have a promocode?</a> -->
				<a href="{{url('/checkout')}}" class="cart-checkout-btn hover-btn">Checkout<i class="uil mt-2 uil-angle-double-right"></i></a>
			</div>
		</div>
	</div>
	<!-- Cart Sidebar Offsetl End-->
	<!-- Header Start -->
	<header class="header clearfix">
		<div class="top-header-group">
			<div class="top-header">
				<div class="res_main_logo">
					<a href="/"><img src="{{asset('front_assets/images/dark-logo-1.svg')}}" alt=""></a>
				</div>
				<div class="main_logo" id="logo">
					<a href="/"><img src="{{asset('front_assets/images/dark-logo-1.svg')}}" alt=""></a>
					<a href="/"><img class="logo-inverse" src="{{asset('front_assets/images/dark-logo-1.svg')}}" alt=""></a>
				</div>
				<div class="select_location">
					<div class="ui inline dropdown loc-title">
						<div class="text">
						  <i class="uil uil-location-point"></i>
						  Gurugram
						</div>
						<i class="uil uil-angle-down icon__14"></i>
						<div class="menu dropdown_loc">
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Gurugram
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								New Delhi
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Bangaluru
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Mumbai
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Hyderabad
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Kolkata
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Ludhiana
							</div>
							<div class="item channel_item">
								<i class="uil uil-location-point"></i>
								Chandigrah
							</div>
						</div>
					</div>
				</div>
				@php if(isset($str)){$string=$str;}else{$string='';} @endphp
				<form id="mainSearchForm" class="search120">
					<div class="ui search">
					  <div class="ui left icon input swdh10">
						<input class="prompt srch10" required="" id="mainSearchFormInput" type="text" value="{{$string}}" placeholder="Search for products..">
						<i class='uil uil-search-alt icon icon1'></i>
					  </div>
					</div>
				</form>
				<div class="header_right">
					<ul>
						<li>
							<a href="tel:{{$my_details[0]->mobile}}" class="offer-link"><i class="uil uil-phone-alt"></i>+91{{$my_details[0]->mobile}}</a>
						</li>
						<li>
							<a href="{{url('/offers')}}" class="offer-link"><i class="uil uil-gift"></i>Offers</a>
						</li>
						<li>
							<a href="{{url('/faq')}}" class="offer-link"><i class="uil uil-question-circle"></i>Help</a>
						</li>
						@if(session()->has('FRONT_USER_LOGIN')!=null)
							@php $checkWishlistItem=checkWishlistItem(session()->get('FRONT_USER_ID'));
							@endphp 
						<li>
							<a href="{{url('/user/wishlist')}}" class="option_links" title="Wishlist"><i class='uil uil-heart icon_wishlist'></i><span class="noti_count1" id="wishlistCounter">{{count($checkWishlistItem)}}</span></a>
						</li>	
						<li class="ui dropdown">
							<a href="#" class="opts_account">
								<img src="{{asset('front_assets/images/avatar/img-5.jpg')}}" alt="">
								<span class="user__name text-capitalize">{{session()->get('FRONT_USER_NAME')}}</span>
								<i class="uil uil-angle-down"></i>
							</a>
							<div class="menu dropdown_account">
								<div class="night_mode_switch__btn">
									<a href="#" id="night-mode" class="btn-night-mode">
										<i class="uil uil-moon"></i> Night mode
										<span class="btn-night-mode-switch">
											<span class="uk-switch-button"></span>
										</span>
									</a>
								</div>	
								<a href="{{url('/user/dashboard')}}" class="item channel_item"><i class="uil uil-apps icon__1"></i>Dashbaord</a>								
								<a href="{{url('/user/orders')}}" class="item channel_item"><i class="uil uil-box icon__1"></i>My Orders</a>
								<a href="{{url('/user/wishlist')}}" class="item channel_item"><i class="uil uil-heart icon__1"></i>My Wishlist</a>
								<a href="{{url('/user/wallet')}}" class="item channel_item"><i class="uil uil-usd-circle icon__1"></i>My Wallet</a>
								<a href="{{url('/user/address')}}" class="item channel_item"><i class="uil uil-location-point icon__1"></i>My Address</a>
								<!-- <a href="offers" class="item channel_item"><i class="uil uil-gift icon__1"></i>Offers</a> -->
								<!-- <a href="faq" class="item channel_item"><i class="uil uil-info-circle icon__1"></i>Faq</a> -->
								<a href="{{url('/user/logout')}}" class="item channel_item"><i class="uil uil-lock-alt icon__1"></i>Logout</a>
							</div>
						</li>
						@else
						<li>
							<a href="{{url('/login')}}" class="offer-link">Login<i class='uil uil-exit'></i></a>
						</li>
						@endif
					</ul>
				</div>
			</div>
		</div>
		<div class="sub-header-group">
			<div class="sub-header">
				<div class="ui dropdown">
					<a href="#" class="category_drop hover-btn" data-toggle="modal" data-target="#category_model" title="Categories"><i class="uil uil-apps"></i><span class="cate__icon">Select Category</span></a>
				</div>
				<nav class="navbar navbar-expand-lg navbar-light py-3">
					<div class="container-fluid">
						<button class="navbar-toggler menu_toggle_btn" type="button" data-target="#navbarSupportedContent"><i class="uil uil-bars"></i></button>
						<div class="collapse navbar-collapse d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end bg-dark1 p-3 p-lg-0 mt1-5 mt-lg-0 mobileMenu" id="navbarSupportedContent">
							<ul class="navbar-nav main_nav align-self-stretch">
								<li class="nav-item"><a href="/" class="nav-link @yield('home_active')" title="Home">Home</a></li>
								<li class="nav-item"><a href="{{url('/featured-products')}}" class="nav-link @yield('featured_active')" title="Featured Products">Featured Products</a></li>
								<li class="nav-item"><a href="{{url('/best-seller-products')}}" class="nav-link @yield('bestSeller_active')" title="Best Seller Products">Best Seller Products</a></li>
								<li class="nav-item"><a href="{{url('/about')}}" class="nav-link @yield('about_active')" title="About Us">About</a></li>
								<li class="nav-item"><a href="{{url('/blog')}}" class="nav-link @yield('blog_active')" title="Blog">Blog</a></li>	
								<li class="nav-item"><a href="{{url('/contact')}}" class="nav-link @yield('contact_active')" title="Contact">Contact Us</a></li>
							</ul>
						</div>
					</div>
				</nav>
				<div class="catey__icon">
					<a href="#" class="cate__btn" data-toggle="modal" data-target="#category_model" title="Categories"><i class="uil uil-apps"></i></a>
				</div>
				<div class="header_cart order-1">
					<a href="#" class="cart__btn hover-btn pull-bs-canvas-left" title="Cart"><i class="uil uil-shopping-cart-alt"></i><span>Cart</span><ins class="cart_number">{{$totalCartItem}}</ins><i class="uil uil-angle-down"></i></a>
				</div>
				<div class="search__icon order-1">
					<a href="#" class="search__btn hover-btn" data-toggle="modal" data-target="#search_model" title="Search"><i class="uil uil-search"></i></a>
				</div>
			</div>
		</div>
	</header>
	<!-- Header End -->	
	<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="dashboard-group">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="user-dt">
							<div class="user-img">
								<img src="{{asset('front_assets/images/avatar/img-5.jpg')}}" alt="">
								@if($customer_info[0]->membership=='active')
								<div class="img-add">													
									<input type="file" id="file" disabled="">
									<label for="file" data-tooltip="Prime Member" data-position="bottom center"><i class="far fa-star" style="font-size: 13px;position: relative;bottom: 7px;left: 0px;"></i></label>
								</div>
								@endif
							</div>
							<h4 class="text-capitalize">{{$customer_info[0]->name}}</h4>
							<p>+91{{$customer_info[0]->mobile}}<!-- <a href="#"><i class="uil uil-edit"></i></a> --></p>
							<div class="earn-points"><img src="{{asset('front_assets/images/Dollar.svg')}}" alt="">Points : <span>0</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<div class="">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4">
						<div class="left-side-tabs">
							<div class="dashboard-left-links">
								<a href="{{url('/user/dashboard')}}" class="user-item @yield('dashboard_active')"><i class="uil uil-apps"></i>Overview</a>
								<a href="{{url('/user/orders')}}" class="user-item @yield('orders_active')"><i class="uil uil-box"></i>My Orders</a>
								<a href="{{url('/user/rewards')}}" class="user-item @yield('rewards_active')"><i class="uil uil-gift"></i>My Rewards</a>
								<a href="{{url('/user/wallet')}}" class="user-item @yield('wallet_active')"><i class="uil uil-wallet"></i>My Wallet</a>
								<a href="{{url('/user/wishlist')}}" class="user-item @yield('wishlist_active')"><i class="uil uil-heart"></i>Wishlist</a>
								<a href="{{url('/user/address')}}" class="user-item @yield('address_active')"><i class="uil uil-location-point"></i>My Address</a>
								<a href="{{url('/user/logout')}}" class="user-item"><i class="uil uil-exit"></i>Logout</a>
							</div>
						</div>
					</div>
					@section('Dashboardcontainer')
					@show 						
				</div>	
			</div>	
		</div>	
	</div>
	<!-- Body End -->     
	<!-- Footer Start -->
	<footer class="footer">
		<div class="footer-first-row">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<ul class="call-email-alt">
							<li><a href="#" class="callemail"><i class="uil uil-dialpad-alt"></i>{{$my_details[0]->mobile}}</a></li>
							<li><a href="#" class="callemail"><i class="uil uil-envelope-alt"></i>{{$my_details[0]->email}}</a></li>
						</ul>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="social-links-footer">
							<ul>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
								<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
								<li><a href="#"><i class="fab fa-instagram"></i></a></li>
								<li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
							</ul>
						</div>
					</div>				
				</div>
			</div>
		</div>
		<div class="footer-second-row">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item">
							<h4>Categories</h4>
							<ul>
								 @foreach($categories as $list2)
								<li><a class="text-capitalize" href="{{url('categories/'.$list2->category_slug)}}">{{$list2->category_name}}</a></li>
								@endforeach						
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item">
							<h4>Useful Links</h4>
							<ul>
								<li><a href="about_us">About US</a></li>
								<li><a href="shop_grid">Featured Products</a></li>
								<li><a href="offers">Offers</a></li>
								<li><a href="our_blog">Blog</a></li>
								<li><a href="faq">Faq</a></li>
								<li><a href="career">Careers</a></li>
								<li><a href="{{url('/contact')}}">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item">
							<h4>Top Cities</h4>
							<ul>
								<li><a href="#">Gurugram</a></li>
								<li><a href="#">New Delhi</a></li>
								<li><a href="#">Bangaluru</a></li>
								<li><a href="#">Mumbai</a></li>
								<li><a href="#">Hyderabad</a></li>
								<li><a href="#">Kolkata</a></li>
								<li><a href="#">Ludhiana</a></li>
								<li><a href="#">Chandigrah</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="second-row-item-app">
							<h4>Download App</h4>
							<ul>
								<li><a href="#"><img class="download-btn" src="{{asset('front_assets/images/download-1.svg')}}" alt=""></a></li>
								<li><a href="#"><img class="download-btn" src="{{asset('front_assets/images/download-2.svg')}}" alt=""></a></li>
							</ul>
						</div>
						<div class="second-row-item-payment">
							<h4>Payment Method</h4>
							<div class="footer-payments">
								<ul id="paypal-gateway" class="financial-institutes">
									<li class="financial-institutes__logo">
									  <img alt="Visa" title="Visa" src="{{asset('front_assets/images/footer-icons/pyicon-6.svg')}}">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="Visa" title="Visa" src="{{asset('front_assets/images/footer-icons/pyicon-1.svg')}}">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="MasterCard" title="MasterCard" src="{{asset('front_assets/images/footer-icons/pyicon-2.svg')}}">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="American Express" title="American Express" src="{{asset('front_assets/images/footer-icons/pyicon-3.svg')}}">
									</li>
									<li class="financial-institutes__logo">
									  <img alt="Discover" title="Discover" src="{{asset('front_assets/images/footer-icons/pyicon-4.svg')}}">
									</li>
								</ul>
							</div>
						</div>
						<div class="second-row-item-payment">
							<h4>Newsletter</h4>
							<form id="newsletterForm" class="newsletter-input">
								<input id="newletterEmail" name="email" type="email" placeholder="Email Address" class="form-control input-md" required="">
								<button class="newsletter-btn hover-btn" type="submit"><i class="uil uil-telegram-alt d-flex justify-content-center"></i></button>
							</form>
							<div class="alert custom_alert mt-2" id="newsletterError" role="alert"></div>								
						</div>						
					</div>
				</div>
			</div>
		</div>
		<div class="footer-last-row">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="footer-bottom-links">
							<ul>
								<li><a href="about_us">About</a></li>
								<li><a href="{{url('/contact')}}">Contact</a></li>
								<li><a href="privacy_policy">Privacy Policy</a></li>
								<li><a href="term_and_conditions">Term & Conditions</a></li>
								<li><a href="refund_and_return_policy">Refund & Return Policy</a></li>
							</ul>
						</div>
						<div class="copyright-text">
							<?php $year=date('Y'); $final_year=substr( $year, -2); ?>
							<i class="uil uil-copyright"></i>Copyright 2020-<?php echo $final_year; ?> <!-- <b>Grockart</b> --> All rights reserved
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer End -->
	
	<!-- add to cart form -->
	<form id="frmAddToCart">
		<input type="hidden" id="product_id" name="product_id">
		<input type="hidden" id="product_qty" name="product_qty">
		@csrf
	</form>
	<!-- add to cart form -->

	<!-- Javascripts -->
	<script src="{{asset('front_assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('front_assets/vendor/OwlCarousel/owl.carousel.js')}}"></script>
	<script src="{{asset('front_assets/vendor/semantic/semantic.min.js')}}"></script>
	<script src="{{asset('front_assets/js/jquery.countdown.min.js')}}"></script>
	<script src="{{asset('front_assets/js/custom.js')}}"></script>
	<script src="{{asset('front_assets/js/product.thumbnail.slider.js')}}"></script>
	<script src="{{asset('front_assets/js/offset_overlay.js')}}"></script>
	<script src="{{asset('front_assets/js/night-mode.js')}}"></script>
	<script src="{{asset('front_assets/js/main.js')}}"></script>
</body>

<!-- Mirrored from gambolthemes.net/html-items/gambo_supermarket_demo/index by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 26 May 2020 11:40:15 GMT -->
</html>
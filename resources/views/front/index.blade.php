@extends('front/layout')
@section('home_active','active')
@section('page_title','Welcome To Grockart')
@section('preloader')
<script>
	jQuery('.loader-wrapper').show();
	jQuery('.main-content').hide();
    $(window).on("load",function(){
    	// setTimeout(function(){
      $(".loader-wrapper").fadeOut("slow");
      $(".main-content").fadeIn('slow');
	  jQuery('.main-content').show();
		// },1500);
    });
</script>
@endsection
@section('container')
<!-- Body Start -->
<div class="wrapper">
	<!-- Offers Start -->
	<div class="main-banner-slider">
		<!-- top running line start -->
		<div class="mx-3" style="position: relative;top: -15px;">
			<marquee behavior="alternate" class="text-capitalize py-2 d-none d-md-block"><p><b>Alert!</b> This is a Dummy Site!! We neither accept nor procced any orders now...</p></marquee>
			<marquee behavior="" class="text-capitalize py-2 d-block d-md-none"><p><b>Alert!</b> This is a Dummy Site!! We neither accept nor procced any orders now...</p></marquee>
		</div>
		<!-- top running line end -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="owl-carousel offers-banner owl-theme">
						@foreach($banner as $banner)
						<div class="item">
							<div class="offer-item">								
								<div class="offer-item-img">
									<div class="gambo-overlay"></div>
									<img src="{{asset('storage/banners/')}}/{{$banner->img}}" alt="">
								</div>
								<div class="offer-text-dt">
									<div class="offer-top-text-banner">
										<p>6% Off</p>
										<div class="top-text-1">{{$banner->tagline}}</div>
										<span>{{$banner->category}}</span>
									</div>
									<a href="{{url('/categories/'.$banner->category_slug)}}" class="Offer-shop-btn hover-btn">Shop Now</a>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Offers End -->
	<!-- Categories Start -->
	<div class="section145">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main-title-tt">
						<div class="main-title-left">
							<span>Shop By</span>
							<h2>Categories</h2>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="owl-carousel cate-slider owl-theme">
						@foreach($categories as $list3)
						<div class="item">
							<a href="{{url('categories/'.$list3->category_slug)}}" class="category-item">
								<div class="cate-img">
									<img src="{{asset('front_assets/images/category')}}/icon-{{$list3->id}}.svg" alt="">
								</div>
								<h4 class="text-capitalize">{{$list3->category_name}}</h4>
							</a>
						</div>
						@endforeach						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Categories End -->
	<!-- Featured Products Start -->
	<div class="section145">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main-title-tt">
						<div class="main-title-left">
							<span>For You</span>
							<h2>Top Featured Products</h2>
						</div>
						<a href="{{url('/featured-products')}}" class="see-more-btn">See All</a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="owl-carousel featured-slider owl-theme">
						@foreach($featured as $featured)
						<div class="item">
							<div class="product-item">
								<a href="{{url('products/'.$featured->slug)}}" class="product-img">
									<img src="{{asset('storage/ProductsImage/')}}/{{$featured->image1}}" alt="">
									<div class="product-absolute-options">
										<span class="offer-badge-1">{{$featured->discount}}% off</span>
										<span class="like-icon" onclick="AddToWishlist('{{$featured->product_id}}')" title="wishlist"></span>
									</div>
								</a>
								<div class="product-text-dt">
									@php
									$totalQty=AvaliableQty($featured->product_id);
							        $SoldQty=SoldQty($featured->product_id);
							        $currentQty=$totalQty-$SoldQty;
									@endphp
									@if($currentQty<=0)
									<p>Available<span>(Out of Stock)</span></p>
									@else
									<p>Available<span>(In Stock)</span></p>
									@endif
									<h4 class="text-capitalize">{{$featured->name}}</h4>
									<div class="product-price">₹{{$featured->price}} <span>₹{{$featured->mrp}}</span></div>
									<div class="qty-cart">
										<div class="quantity buttons_added">
											<input type="button" value="-" class="minus minus-btn">
											@php $rand=rand(111,999); @endphp
											<input type="number" step="1" name="quantity" value="1" id="Qty{{$featured->slug}}{{$featured->product_id}}{{$rand}}" class="input-text qty text">
											<!-- <input type="number" step="1" name="quantity" id="" value="1" class="input-text qty text"> -->
											<input type="button" value="+" class="plus plus-btn">
										</div>
										@if($currentQty>=1)
										<span class="cart-icon"><i class="uil uil-shopping-cart-alt" onclick="AddToCartCarousel('{{$featured->product_id}}', '{{$featured->slug}}', '{{$rand}}')"></i></span>
										@endif
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Featured Products End -->
	<!-- Best Values Offers Start -->
	<div class="section145">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main-title-tt">
						<div class="main-title-left">
							<span>Offers</span>
							<h2>Best Values</h2>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<a href="{{url('/latest-products')}}" class="best-offer-item">
						<img src="{{asset('storage/offers/img-4.jpg')}}" alt="">
					</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<a href="{{url('/discounted-products')}}" class="best-offer-item">
						<img src="{{asset('front_assets/images/best-offers/offer-2.jpg')}}" alt="">
					</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<a href="{{url('/featured-products')}}" class="best-offer-item offr-none">
						<img src="{{asset('front_assets/images/best-offers/offer-3.jpg')}}" alt="">
						<div class="cmtk_dt">
							<div class="product_countdown-timer offer-counter-text" data-countdown="2021/08/15"></div>
						</div>
					</a>
				</div>
				<!-- <div class="col-md-12">
					<a href="#" class="code-offer-item">
						<img src="{{asset('front_assets/images/best-offers/offer-4.jpg')}}" alt="">
					</a>
				</div> -->
			</div>
		</div>
	</div>
	<!-- Best Values Offers End -->
	<!-- Best Seller Start -->
	<div class="section145">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main-title-tt">
						<div class="main-title-left">
							<span>For You</span>
							<h2>Best Seller Products</h2>
						</div>
						<a href="{{url('/best-seller-products')}}" class="see-more-btn">See All</a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="owl-carousel featured-slider owl-theme">
						@foreach($best_seller as $best_seller)
						<div class="item">
							<div class="product-item">
								<a href="{{url('products/'.$best_seller->slug)}}" class="product-img">
									<img src="{{asset('storage/ProductsImage/')}}/{{$best_seller->image1}}" alt="">
									<div class="product-absolute-options">
										<span class="offer-badge-1">{{$best_seller->discount}}% off</span>
										<span class="like-icon" onclick="AddToWishlist('{{$best_seller->product_id}}')" title="wishlist"></span>
									</div>
								</a>
								<div class="product-text-dt">
									@php
									$totalQty=AvaliableQty($best_seller->product_id);
							        $SoldQty=SoldQty($best_seller->product_id);
							        $currentQty=$totalQty-$SoldQty;
									@endphp
									@if($currentQty<=0)
									<p>Available<span>(Out of Stock)</span></p>
									@else
									<p>Available<span>(In Stock)</span></p>
									@endif
									<h4 class="text-capitalize">{{$best_seller->name}}</h4>
									<div class="product-price">₹{{$best_seller->price}} <span>₹{{$best_seller->mrp}}</span></div>
									<div class="qty-cart">
										<div class="quantity buttons_added">
											<input type="button" value="-" class="minus minus-btn">
											@php $rand=rand(111,999); @endphp
											<input type="number" step="1" name="quantity" value="1" id="Qty{{$best_seller->slug}}{{$best_seller->product_id}}{{$rand}}" class="input-text qty text">
											<!-- <input type="number" step="1" name="quantity" id="" value="1" class="input-text qty text"> -->
											<input type="button" value="+" class="plus plus-btn">
										</div>
										@if($currentQty>=1)
										<span class="cart-icon"><i class="uil uil-shopping-cart-alt" onclick="AddToCartCarousel('{{$best_seller->product_id}}', '{{$best_seller->slug}}', '{{$rand}}')"></i></span>
										@endif
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Best Seller Products End -->
	<!-- New Products Start -->
	<div class="section145">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main-title-tt">
						<div class="main-title-left">
							<span>For You</span>
							<h2>Added New Products</h2>
						</div>
						<a href="{{url('/latest-products')}}" class="see-more-btn">See All</a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="owl-carousel featured-slider owl-theme">
						@foreach($latest_products as $latest_products)
						<div class="item">
							<div class="product-item">
								<a href="{{url('products/'.$latest_products->slug)}}" class="product-img">
									<img src="{{asset('storage/ProductsImage/')}}/{{$latest_products->image1}}" alt="">
									<div class="product-absolute-options">
										<span class="offer-badge-1">{{$latest_products->discount}}% off</span>
										<span class="like-icon" onclick="AddToWishlist('{{$latest_products->product_id}}')" title="wishlist"></span>
									</div>
								</a>
								<div class="product-text-dt">
									@php
									$totalQty=AvaliableQty($latest_products->product_id);
							        $SoldQty=SoldQty($latest_products->product_id);
							        $currentQty=$totalQty-$SoldQty;
									@endphp
									@if($currentQty<=0)
									<p>Available<span>(Out of Stock)</span></p>
									@else
									<p>Available<span>(In Stock)</span></p>
									@endif
									<h4 class="text-capitalize">{{$latest_products->name}}</h4>
									<div class="product-price">₹{{$latest_products->price}} <span>₹{{$latest_products->mrp}}</span></div>
									<div class="qty-cart">
										<div class="quantity buttons_added">
											<input type="button" value="-" class="minus minus-btn">
											@php $rand=rand(111,999); @endphp
											<input type="number" step="1" name="quantity" value="1" id="Qty{{$latest_products->slug}}{{$latest_products->product_id}}{{$rand}}" class="input-text qty text">
											<!-- <input type="number" step="1" name="quantity" id="" value="1" class="input-text qty text"> -->
											<input type="button" value="+" class="plus plus-btn">
										</div>
										@if($currentQty>=1)
										<span class="cart-icon"><i class="uil uil-shopping-cart-alt" onclick="AddToCartCarousel('{{$latest_products->product_id}}', '{{$latest_products->slug}}', '{{$rand}}')"></i></span>
										@endif
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- New Products End -->
	<!-- New Products Start -->
	<div class="section145">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="main-title-tt">
						<div class="main-title-left">
							<span>For You</span>
							<h2>Discounted Products</h2>
						</div>
						<a href="{{url('/discounted-products')}}" class="see-more-btn">See All</a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="owl-carousel featured-slider owl-theme">
						@foreach($discounted as $discounted)
						<div class="item">
							<div class="product-item">
								<a href="{{url('products/'.$discounted->slug)}}" class="product-img">
									<img src="{{asset('storage/ProductsImage/')}}/{{$discounted->image1}}" alt="">
									<div class="product-absolute-options">
										<span class="offer-badge-1">{{$discounted->discount}}% off</span>
										<span class="like-icon" onclick="AddToWishlist('{{$discounted->product_id}}')" title="wishlist"></span>
									</div>
								</a>
								<div class="product-text-dt">
									@php
									$totalQty=AvaliableQty($discounted->product_id);
							        $SoldQty=SoldQty($discounted->product_id);
							        $currentQty=$totalQty-$SoldQty;
									@endphp
									@if($currentQty<=0)
									<p>Available<span>(Out of Stock)</span></p>
									@else
									<p>Available<span>(In Stock)</span></p>
									@endif
									<h4 class="text-capitalize">{{$discounted->name}}</h4>
									<div class="product-price">₹{{$discounted->price}} <span>₹{{$discounted->mrp}}</span></div>
									<div class="qty-cart">
										<div class="quantity buttons_added">
											<input type="button" value="-" class="minus minus-btn">
											@php $rand=rand(111,999); @endphp
											<input type="number" step="1" name="quantity" value="1" id="Qty{{$discounted->slug}}{{$discounted->product_id}}{{$rand}}" class="input-text qty text">
											<!-- <input type="number" step="1" name="quantity" id="" value="1" class="input-text qty text"> -->
											<input type="button" value="+" class="plus plus-btn">
										</div>
										@if($currentQty>=1)
										<span class="cart-icon"><i class="uil uil-shopping-cart-alt" onclick="AddToCartCarousel('{{$discounted->product_id}}', '{{$discounted->slug}}', '{{$rand}}')"></i></span>
										@endif
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- New Products End -->

</div>
<!-- Body End -->
	
	<?php if(!isset($_COOKIE['grockart_visit'])){ ?>
	<div class="alert text-center show cookiealert" role="alert">
	    We use cookies, so you get the best experience <a href="privacy-policy" style="color: #fff" target="_blank">Learn more</a>
	    <a class="acceptcookies ml-1">Allow</a>
	</div>
	<?php } ?>
	<script type="text/javascript">
		(function () {
		    "use strict";

		    var cookieAlert = document.querySelector(".cookiealert");
		    var acceptCookies = document.querySelector(".acceptcookies");

		    if (!cookieAlert) {
		       return;
		    }

		    cookieAlert.offsetHeight; // Force browser to trigger reflow (https://stackoverflow.com/a/39451131)

		    // Show the alert if we cant find the "acceptCookies" cookie
		    if (!getCookie("grockart_visit")) {
		        cookieAlert.classList.add("show");
				jQuery.ajax({
			      url:'/setUserCookie',
			      type:'post'
			    });
		        setCookie("grockart_visit", true, 365);
		    }
		    acceptCookies.addEventListener("click", function () {
		        setCookie("grockart_visit", true, 365);
		        cookieAlert.classList.remove("show");
		        window.dispatchEvent(new Event("cookieAlertAccept"))
		    });

		    function setCookie(cname, cvalue, exdays) {
		        var d = new Date();
		        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		        var expires = "expires=" + d.toUTCString();
		        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		    }

		    function getCookie(cname) {
		        var name = cname + "=";
		        var decodedCookie = decodeURIComponent(document.cookie);
		        var ca = decodedCookie.split(';');
		        for (var i = 0; i < ca.length; i++) {
		            var c = ca[i];
		            while (c.charAt(0) === ' ') {
		                c = c.substring(1);
		            }
		            if (c.indexOf(name) === 0) {
		                return c.substring(name.length, c.length);
		            }
		        }
		        return "";
		    }
		})();
	</script>
	<style type="text/css">
		.loader-wrapper {
			width: 100%;
			height: 100vh;
			position: relative;
			top: 0;
			z-index: 9999;
			left: 0;
			background-color: #fff;
			display:flex;
			justify-content: center;
			align-items: center;
		}
		.load-wrapper-img{
			margin: auto;
			width:300px;
			height:300px;
			position: relative;
			top: -40px;
			right: 0;
			left: 0;
			bottom: 0;
		}
		.cookiealert {
		    position: fixed;
		    bottom: 0;
		    left: 0;
		    width: 100%;
		    margin: 0 !important;
		    z-index: 999;
		    opacity: 0;
		    visibility: hidden;
		    border-radius: 0;
		    transform: translateY(100%);
		    transition: all 500ms ease-out;
		    color: #fff;
		    background: #2b2f4c;
		}
		@media(max-width: 600px){
			.cookiealert {
			    bottom: 0px;
			}
			.cookiealert.show {
			    opacity: 0.8;
			    visibility: visible;
			    transform: translateY(20%);
			    transition-delay: 1000ms;
			}
		}

		.cookiealert.show {
		    opacity: 0.8;
		    visibility: visible;
		    transform: translateY(0%);
		    transition-delay: 1000ms;
		}

		.cookiealert a, .cookiealert a:hover {
		    text-decoration: underline !important;
		}

		.cookiealert .acceptcookies {
		    margin-left: 10px;
		    vertical-align: baseline;
		}
	</style>
@endsection
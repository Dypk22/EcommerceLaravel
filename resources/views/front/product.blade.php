@extends('front/layout')
@section('home_active','')
@section('page_title','Buy '.ucwords($product[0]->meta_title))
@section('container')

@php
$stock='';
if($availableQty!=0){
 $stock='Instock';
}
else{
 $stock='Out of Stock';
}
@endphp
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
<!-- Body Start -->
<div class="wrapper">
	<div class="gambo-Breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/">Home</a></li>
							<li class="breadcrumb-item"><a href="{{url('categories/'.$currentCategories[0]->category_slug)}}" class="text-capitalize">{{$currentCategories[0]->category_name}}</a></li>

							<!-- <li class="breadcrumb-item text-capitalize" aria-current="page">{{$product[0]->name}}</li> -->
							<li class="breadcrumb-item active d-none d-md-block text-capitalize" aria-current="page">{{$product[0]->name}}</li>
							@php $roduct_name_substring = explode(' ', $product[0]->name); @endphp
							@if(count($roduct_name_substring)==1)
							<li class="breadcrumb-item active d-md-none text-capitalize" aria-current="page">{{$roduct_name_substring[0]}}</li>
							@elseif(count($roduct_name_substring)==2)
							<li class="breadcrumb-item active d-md-none text-capitalize" aria-current="page">{{$roduct_name_substring[0].' '.$roduct_name_substring[1]}}</li>
							@elseif(count($roduct_name_substring)==3)
							<li class="breadcrumb-item active d-md-none text-capitalize" aria-current="page">{{$roduct_name_substring[0].' '.$roduct_name_substring[1].' '.$roduct_name_substring[2]}}</li>
							@else
							<li class="breadcrumb-item active d-md-none text-capitalize" aria-current="page">{{$roduct_name_substring[0].' '.$roduct_name_substring[1].' '.$roduct_name_substring[2].' ...'}}</li>														
							@endif
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
					<div class="product-dt-view">
						<div class="row">
							<div class="col-lg-4 col-md-4">
								<div id="sync1" class="owl-carousel owl-theme">
									<div class="item">
										<img src="{{asset('storage/ProductsImage/'.$product[0]->image1)}}" alt="">
									</div>
									<div class="item">
										<img src="{{asset('storage/ProductsImage/'.$product[0]->image2)}}" alt="">
									</div>
									<div class="item">
										<img src="{{asset('storage/ProductsImage/'.$product[0]->image3)}}" alt="">
									</div>
									<div class="item">
										<img src="{{asset('storage/ProductsImage/'.$product[0]->image4)}}" alt="">
									</div>
								</div>
								<div id="sync2" class="owl-carousel owl-theme">
									<div class="item">
										<img src="{{asset('storage/ProductsImage/'.$product[0]->image1)}}" alt="">
									</div>
									<div class="item">
										<img src="{{asset('storage/ProductsImage/'.$product[0]->image2)}}" alt="">
									</div>
									<div class="item">
										<img src="{{asset('storage/ProductsImage/'.$product[0]->image3)}}" alt="">
									</div>
									<div class="item">
										<img src="{{asset('storage/ProductsImage/'.$product[0]->image4)}}" alt="">
									</div>
								</div>
							</div>
							<div class="col-lg-8 col-md-8">
								<div class="product-dt-right">
									<h2 class="text-capitalize">{{$product[0]->name}}</h2>
									<div class="no-stock">
										<p class="pd-no">{{$product[0]->rating}}<i class="far fa-star"></i></p>
										<p class="stock-qty">Available<span>({{$stock}})</span></p>
									</div>
									<div class="product-radio">
										<ul class="product-now">
											@foreach($weight as $weight)
											<li>
												<input type="radio" id="{{$weight->weight}}" name="product1">
												<label for="{{$weight->weight}}" onclick='window.location.href="{{$weight->slug}}"'>{{$weight->weight}}</label>
											</li>
											@endforeach
										</ul>
									</div>
									<p class="pp-descp">{{$final_shortdesc}}</p>
									<div class="product-group-dt">
										<ul>
											<li><div class="main-price color-discount">Discount Price<span>₹{{$product[0]->price}}</span></div></li>
											<li><div class="main-price mrp-price">MRP Price<span>₹{{$product[0]->mrp}}</span></div></li>
										</ul>
										<ul class="gty-wish-share">
											<li>
												<div class="qty-product">
													<div class="quantity buttons_added">
														<input type="button" value="-" class="minus minus-btn">
														<input type="number" step="1" name="quantity" value="1" id="product__qty" class="input-text qty text">
														<input type="button" value="+" class="plus plus-btn">
													</div>
												</div>
											</li>
											<li><span class="like-icon save-icon" onclick="AddToWishlist('{{$product[0]->product_id}}')" title="wishlist"></span></li>
										</ul>
										<ul class="ordr-crt-share">
											@if($stock=='Instock')
											<li><button class="add-cart-btn hover-btn" onclick="AddToCart('{{$product[0]->product_id}}')"><i class="uil uil-shopping-cart-alt"></i>Add to Cart</button></li>
											<li><button class="order-btn hover-btn" onclick="orderNow('{{$product[0]->product_id}}')"><a style="color: #f55d2c;" href="{{url('checkout')}}">Order Now</a></button></li>
											@else
											<li><button class="add-cart-btn hover-btn" onclick="NotifyMe('{{$product[0]->product_id}}')"><i class="uil uil-shopping-cart-alt"></i>Notify Me</button></li>
											@endif
										</ul>
									</div>
									<div class="alert alert-warning alert-dismissible fade show" style="display: none;" id="product_alert" role="alert">
									   <span id="product_alert_msg"></span>
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									    <span aria-hidden="true">&times;</span>
									  </button>
									</div>
									<div class="pdp-details">
										<ul>
											<li>
												<div class="pdp-group-dt">
													<div class="pdp-icon"><i class="uil uil-usd-circle"></i></div>
													<div class="pdp-text-dt">
														<span>Lowest Price Guaranteed</span>
														<p>Get assured that you can't find it cheaper anywhere else.</p>
													</div>
												</div>
											</li>
											<li>
												<div class="pdp-group-dt">
													<div class="pdp-icon"><i class="uil uil-cloud-redo"></i></div>
													<div class="pdp-text-dt">
														<span>Easy Returns & Refunds</span>
														<p>Return products at doorstep and get refund in seconds.</p>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-12">
					<div class="pdpt-bg">
						<div class="pdpt-title">
							<h4>More Like This</h4>
						</div>
						<div class="pdpt-body scrollstyle_4">
							@foreach($discounted as $discounted)
							<div class="cart-item border_radius">
								<div class="cart-product-img">
									<img src="{{asset('storage/ProductsImage/')}}/{{$discounted->image1}}" alt="">
									<div class="offer-badge">{{$discounted->discount}}% OFF</div>
								</div>
								<div class="cart-text">
									@php $roduct_name_substring = explode(' ', $discounted->name); $link=url('products/'.$discounted->slug) @endphp
									<h4 class="custom_hover" onclick='window.location.href="{{$link}}"'><span class="d-none d-md-block text-capitalize">{{$discounted->name}}</span>
									<span class="d-md-none text-capitalize">{{$roduct_name_substring[0]}}
										@if(isset($roduct_name_substring[1])) {{$roduct_name_substring[1]}} @endif 
										@if(isset($roduct_name_substring[2])) {{$roduct_name_substring[2]}} @endif
										@if(isset($roduct_name_substring[3]) && isset($roduct_name_substring[4]))
											@if(strlen($roduct_name_substring[3])>3)
											{{$roduct_name_substring[3]}}
											@else {{$roduct_name_substring[3].' '.$roduct_name_substring[4].' ...'}}
											@endif
										@else
											@if(isset($roduct_name_substring[3]) && strlen($roduct_name_substring[3])>3)
											{{$roduct_name_substring[3].' ...'}}
											@endif
										@endif
									</span></h4>
									<!-- <h4><a href="{{url('products/'.$discounted->slug)}}" style="color: #2b2f4c;text-transform: capitalize;">{{$discounted->name}}</a></h4> -->
									@php
									$totalQty=AvaliableQty($discounted->product_id);
							        $SoldQty=SoldQty($discounted->product_id);
							        $currentQty=$totalQty-$SoldQty;
									@endphp
									<div class="cart-item-price">₹{{$discounted->price}} <span>₹{{$discounted->mrp}}</span></div>
									<div class="qty-group">
										<div class="quantity buttons_added">
											<input type="button" value="-" class="minus minus-btn">
											@php $rand=rand(111,999); @endphp
											<input type="number" step="1" name="quantity" value="1" id="Qty{{$discounted->slug}}{{$discounted->product_id}}{{$rand}}" class="input-text qty text">
											<!-- <input type="number" step="1" name="quantity" value="1" class="input-text qty text"> -->
											<input type="button" value="+" class="plus plus-btn">
										</div>
										@if($currentQty!=0)
										<span class="cart-item-price"><i class="uil uil-shopping-cart-alt custom_hover" style="font-size: 1.3rem;" onclick="AddToCartCarousel('{{$discounted->product_id}}', '{{$discounted->slug}}', '{{$rand}}')"></i></span>
										@endif
										<!-- <div class="cart-item-price">$12 <span>$15</span></div> -->
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-12">
					<div class="pdpt-bg">
						<div class="pdpt-title">
							<h4>Product Details</h4>
						</div>
						<div class="pdpt-body scrollstyle_4">
							<div class="pdct-dts-1">
								<div class="pdct-dt-step">
									<h4>Description</h4>
									<p>{{$final_desc}}</p>
								</div>
								<div class="pdct-dt-step">
									<h4>Unit</h4>
									<div class="product_attr">{{$product[0]->weight}}</div>
								</div>
								<div class="pdct-dt-step">
									<h4>Seller</h4>
									<div class="product_attr">
										Grockart Pvt Ltd, Haridwar, 249401
									</div>
								</div>
								<div class="pdct-dt-step">
									<h4>Disclaimer</h4>
									<p>Every effort is made to maintain the accuracy of all information. However, actual product packaging and materials may contain more and/or different information. It is recommended not to solely rely on the information presented.</p>
								</div>
							</div>			
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>
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
</div>
<!-- Body End -->
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
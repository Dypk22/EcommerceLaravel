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
	<script type="text/javascript">
		// window.addEventListener("online", function(){
		// 	alert('you\'re online');
		// });
		// window.addEventListener("online", function(){
		// 	alert('you\'re offline');
		// });
	</script>

</head>

<body>	
	<span class="loader-wrapper">
		<!-- <img class="load-wrapper-img" src="https://cdn.dribbble.com/users/2042929/screenshots/11242267/media/0a8389d78ae33ae6d1f58f2dd0a7c99f.gif"/> -->
		<img class="load-wrapper-img" src="{{asset('front_assets/images/loader.gif')}}"/>
    </span>
	@section('preloader')
	@show
	<span class="main-content">
		<!-- alert toast start -->
		<!-- <div class="alert custom_toast hide">
		    <span class="msg">This is a warning alert This is a warning alert!</span>
		    <span class="fas fa-exclamation-circle"></span>
		 </div> -->
		<!-- alert toast end -->			
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
										<img src="{{asset('front_assets/images/category')}}/icon-{{rand(1,11)}}.svg" alt="">
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
		<!-- login Model Start-->
		<div id="login_modal" class="header-cate-model modal fade pr-0" tabindex="-1" role="dialog" aria-modal="false">
	        <div class="modal-dialog category-area" role="document">
	            <div class="category-area-inner">
	                <div class="modal-header">
	                </div>
	                <div class="category-model-content modal-content" style="margin-bottom: 60px;top: 50px"> 
						<div class="row justify-content-center">
							<div class="col-lg-10">
								<div class="card custom_modal">
									<article class="card-body p-0">
										<div class="float-right btn custom_button"><a href="#">Sign up</a></div>
										<h4 class="card-title mb-4 mt-1">Sign in</h4>
										<p class="mt-5">
											@php
											if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pwd'])){
											$login_email=$_COOKIE['login_email'];
											$login_pwd=$_COOKIE['login_pwd'];
											$is_remember="checked='checked'";
											} else{
											$login_email='';
											$login_pwd='';
											$is_remember="";
											}   

											@endphp											
											<div class="btn d-block my-1 custom_button"><a href="#" style="font-size: 15px;"><i class="fab fa-twitter"></i> Login via Twitter</a></div>
											<div class="btn d-block my-1 custom_button"><a href="#" style="font-size: 15px;"><i class="fab fa-facebook-f"></i> Login via facebook</a></div>
											<!-- <a href="" class="btn btn-block btn-outline-info"> <i class="fab fa-twitter"></i>   Login via Twitter</a> -->
											<!-- <a href="" class="btn btn-block btn-outline-primary"> <i class="fab fa-facebook-f"></i>   Login via facebook</a> -->
										</p>
										<hr style="background: #f55d2c;">
										<form id="frmLogin">
										    <div class="form-group">
										        <input id="login_email" name="login_email" class="form-control" value="{{$login_email}}" placeholder="Email" required="" type="email">
										    </div> <!-- form-group// -->
										    <div class="form-group">
										        <input class="form-control" id="login_password" name="login_password" value="{{$login_pwd}}" placeholder="******" required="" type="password">
										    </div> <!-- form-group// -->                                      
										    <div class="row">
												<div id="login_msg" style="font-size: 14px; font-family: 'Roboto', sans-serif; display: none; margin-left: 15px" class="alert alert-danger alert-dismissible fade show col-10" role="alert">
												  <strong>Alert!</strong> <span id="main_login_msg"></span>
												  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												    <span aria-hidden="true">&times;</span>
												  </button>
												</div>
												<label for="rememberme" class="rememberme form-group col-md-12">
								              		<input type="checkbox" id="rememberme" name="rememberme" {{$is_remember}}> Remember me 
								              	</label>		
												<div class="col-6">
										            <div class="form-group">
										                <button onclick="signinUser('reload')" type="button" id="btnLogin" class="btn d-block custom_button">Sign In Now <i class="fas fa-sign-in-alt"></i></button>
										            </div> <!-- form-group// -->
										        </div>
										        <div class="col-6 text-right">
										            <a class="small color-tomato" href="#">Forgot password?</a>
										        </div>                                            
										    </div> <!-- .row// -->     
											@csrf                                                             
										</form>
									</article>
								</div>												
							</div>
						</div>					
						<!-- <a href="#" class="morecate-btn"><i class="uil uil-apps"></i>More Categories</a> -->
	                </div>
	            </div>
	        </div>
	    </div>
		<!-- login Model End-->	
		<!-- login Model Start-->
		<div id="login_modal_home" class="header-cate-model modal fade pr-0" tabindex="-1" role="dialog" aria-modal="false">
	        <div class="modal-dialog category-area mx-auto" style="width: 90%;" role="document">
	            <div class="category-area-inner">
	                <div class="category-model-content modal-content" style="top: 50px;background: #f9f9f9;padding-bottom: 20px;border-radius: 5px !important;"> 
						<div class="row justify-content-center">
							<div class="col-lg-10">
								<div class="card custom_modal" style="background: #f9f9f9;">
									<article class="card-body px-3">
										<div id="sec_1">
											<center style="font-size: 16px;padding: 15px;padding-bottom: 25px;" class="text-capitalize">Enter your phone number to <br>Login/Sign up</center>
											<div class="form-group pos_rel">
												<input id="login_number" type="number" placeholder="Phone Number" class="form-control lgn_input">
												<i class="uil uil-mobile-android-alt lgn_icon"></i>
											</div>
									    	<button class="login-btn hover-btn" id="login_next__1" onclick="login_next()">Next</button>
										</div>
										<!-- for registered user i.e. login -->
										<div id="sec_2" style="display: none;">
											<center style="font-size: 16px;padding: 15px;padding-bottom: 25px;" class="text-capitalize">Enter your password to continue</center>
											<div class="form-group pos_rel">
												<input id="login_number_final" readonly="" type="text" placeholder="Phone Number" class="form-control lgn_input">
												<i class="uil uil-mobile-android-alt lgn_icon"></i>
											</div>
											<div class="form-group pos_rel">
												<input id="login_password_final" type="password" placeholder="Password" class="form-control lgn_input">
												<i class="uil uil-padlock lgn_icon"></i>
											</div>
											<!-- <div class="alert custom_alert" id="loginError__1" role="alert"></div> -->
									    	<button class="login-btn hover-btn" id="login_next__2" onclick="login_next_sec_2()">Sign In Now <i class="fas fa-sign-in-alt"></i></button>
									    	<div class="form-group pos_rel text-center">
									    		<label style="font-size: 14px; margin-top: 10px;color: #f55d2c;" class="custom_hover" onclick="forgetPassword()">Forgot Password</label>
											</div>
										</div>
										<!-- for reset password user  -->
										<div id="sec_5" style="display: none;">
											<center style="font-size: 16px;padding: 15px;padding-bottom: 25px;" class="text-capitalize">Reset Your Password</center>
											<div class="form-group pos_rel">
												<input id="forget_email" type="text" placeholder="Enter Your Mobile or E-Mail" class="form-control lgn_input">
												<i class="uil uil-envelope lgn_icon"></i>
											</div>
											<!-- <div class="alert custom_alert" id="loginError__1" role="alert"></div> -->
									    	<button class="login-btn hover-btn" id="login_next__5" onclick="reset_password_email()">Reset Password <i class="fas fa-sign-in-alt"></i></button>
										</div>
										<!-- for registered otp user i.e. login -->
										<div id="sec_3" style="display: none;">
											<div class="form-group pos_rel text-center">
												<!-- <label class="control-label" style="font-size: 1rem;">We've sent a verification code on <span id="conNum"></span></label><br>-->
												<label class="control-label mb-0" style="font-size: 1rem">Enter OTP sent on <span id="conNum"></span></label><br>
											</div>	
											<div class="form-group pos_rel text-center">
												<ul class="code-alrt-inputs mb-4 signup-code-list">
													<li>
														<input id="code1" maxlength="1" autofocus="" name="number" type="text" onkeyup="movetoNext(this, 'code2')" class="form-control input-md">
													</li>
													<li>
														<input id="code2" maxlength="1" name="number" type="text" onkeyup="movetoNext(this, 'code3')" class="form-control input-md">
													</li>
													<li>
														<input id="code3" maxlength="1" name="number" type="text" onkeyup="movetoNext(this, 'code4')" class="form-control input-md">
													</li>
													<li>
														<input id="code4" maxlength="1" name="number" type="text" onkeyup="movetoNext(this, 'code5')" class="form-control input-md">
													</li>
													<li>
														<input id="code5" maxlength="1" name="number" type="text" class="form-control input-md">
													</li>
												</ul>
											</div>
											<div class="alert custom_alert" id="loginError__2" role="alert"></div>
									    	<button class="login-btn hover-btn" id="login_next__3" onclick="otp_next_sec_4()">Next</button>
										</div>
										<!-- for registration i.e. register -->
										<div id="sec_4" style="display: none;">
											<center style="font-size: 16px;padding: 15px;padding-bottom: 25px;" class="text-capitalize">complete sign up</center>
											<div class="form-group pos_rel">
												<input id="sign_up_name" type="text" placeholder="Full name" class="form-control lgn_input">
												<i class="uil uil-user-circle lgn_icon"></i>
											</div>
											<div class="form-group pos_rel">
												<input id="sign_up_email" type="email" placeholder="Email Address" class="form-control lgn_input">
												<i class="uil uil-envelope lgn_icon"></i>
											</div>
											<div class="form-group pos_rel">
												<input id="sign_up_number" type="hidden">
												<input id="sign_up_password" type="password" placeholder="Password" class="form-control lgn_input">
												<i class="uil uil-padlock lgn_icon"></i>
											</div>
											<div class="form-group pos_rel">
												<input id="refer_code" type="text" placeholder="Have Refer Code? (If Any)" class="form-control lgn_input">
												<i class="uil uil-question-circle lgn_icon"></i>
											</div>
											<div class="alert custom_alert" id="loginError__3" role="alert"></div>
									    	<button class="login-btn hover-btn" id="registration_next" onclick="registration_next()">Sign Up Now <i class="fas fa-sign-in-alt"></i></button>
										</div>
									</article>
								</div>												
							</div>
						</div>					
						<!-- <a href="#" class="morecate-btn"><i class="uil uil-apps"></i>More Categories</a> -->
	                </div>
	            </div>
	        </div>
	    </div>
		<!-- login Model End-->	
		<!-- login Model Start-->
		<div id="get_city" class="header-cate-model modal fade pr-0" tabindex="-1" role="dialog" aria-modal="false">
	        <div class="modal-dialog category-area mx-auto" style="width: 90%;" role="document">
	            <div class="category-area-inner">
	                <div class="category-model-content modal-content get_city_res" style="top: 50px;background: #f9f9f9;border-radius: 5px !important;"> 
						<div class="row justify-content-center">
							<div class="col-lg-10">
								<div class="card" style="background: #f9f9f9; border: none;">
									<article class="card-body">
  									    @php if(isset($_COOKIE['Location'])) { @endphp
										<div id="get_ciyt_sec_4">
											<div class="text-center">
												<i style="font-size: 50px;color: #f55d2c;" class="uil uil-check-circle"></i>
											</div>
											<center style="font-size: 14px;padding: 15px;">Currently you're viewing - 
												<span class="text-capitalize d-block d-md-inline">@php echo $_COOKIE['Location']; @endphp super store</span>
												<span class="d-block">Didn't correct information?</span>
											</center>
											<div class="form-group pos_rel w-75 mx-auto">
												<input id="pinCOde" type="number" required="" name="pincode" placeholder="Enter Pin Code" class="form-control lgn_input">
												<i class="uil uil-location-point lgn_icon"></i>
											</div>
									    	<button class="login-btn hover-btn mb-2" type="button" onclick="updatePincode()" id="btn_update_pinCOde">Update</button>
										</div>
							  			@php } else { @endphp
										<div id="get_ciyt_sec_1">
											<center style="font-size: 14px;padding: 15px;" class="text-capitalize">Enter Your Pin Code For Correspond Store</center>
											<div class="form-group pos_rel">
												<input id="pinCOde" type="number" required="" name="pincode" placeholder="Pin Code" class="form-control lgn_input">
												<i class="uil uil-location-point lgn_icon"></i>
											</div>
									    	<button class="login-btn hover-btn mb-2" type="button" onclick="getPincode()" id="btn_pinCOde">Continue</button>
										</div>
							  			@php } @endphp
										<div id="get_city_sec_2" class="text-center py-2" style="display: none;">
											<div><i style="font-size: 50px;color: #f55d2c;" class="uil uil-check-circle"></i></div>
											<div class="py-2 text-capitalize notMsg" style="font-size: 14px;"></div>
									    	<button class="login-btn hover-btn mt-2" data-dismiss="modal" aria-label="Close" type="button">Start Shopping</button>
										</div>
										<div id="get_city_sec_3" class="text-center py-2" style="display: none;">
											<div><i style="font-size: 50px;color: #f55d2c;" class="far fa-times-circle"></i></div>
											<div class="text-capitalize mt-3 notMsg" style="font-size: 14px;"></div>
									    	<button class="login-btn hover-btn mt-2" onclick="window.location.href='/faq';" type="button">Check Available Cities</button>
									    	<!-- <button class="login-btn hover-btn mt-2" type="button">Start Shopping</button> -->
										</div>
									</article>
								</div>												
							</div>
						</div>					
						<!-- <a href="#" class="morecate-btn"><i class="uil uil-apps"></i>More Categories</a> -->
	                </div>
	            </div>
	        </div>
	    </div>
		<!-- login Model End-->	
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
							<form id="mobileSearch">
								<input type="text" id="mobileSearchInput" required="" placeholder="Search for products...">
								<button type="submit"><i class="uil uil-search"></i></button>
							</form>
						</div>
						<div class="search-by-cat">
	                        @foreach($categories as $list1)
	                        <a href="{{url('categories/'.$list1->category_slug)}}" class="single-cat">
	                            <div class="icon">
									<img src="{{asset('front_assets/images/category')}}/icon-{{$list1->id}}.svg" alt="">
	                            </div>
	                            <div class="text text-capitalize">
	                                {{$list1->category_name}}
	                            </div>
	                        </a>
							@endforeach
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
						<h4>Grockart Super Market</h4>
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
							@php $roduct_name_substring = explode(' ', $cartItem->name); $link=url('products/'.$cartItem->slug) @endphp
							<h4 onclick='window.location.href="{{$link}}"'><span class="d-none d-md-block text-capitalize">{{$cartItem->name}}</span>
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
					<a href="{{url('/checkout')}}" class="cart-checkout-btn hover-btn">Checkout<i class="uil uil-angle-right"></i></a>
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
							  @php if(isset($_COOKIE['Location'])) { @endphp
							  <span class="text-capitalize">{{$_COOKIE['Location']}}</span>
							  @php } else { @endphp
							  <span class="text-capitalize">Haridwar</span>
							  @php } @endphp
							</div>
							<i class="uil uil-angle-down icon__14"></i>
							<div class="menu dropdown_loc">
								<div class="item channel_item haridwar">
									<i class="uil uil-location-point"></i>
								    <span onclick="setPincode('249401')">Haridwar</span>
								</div>
								<div class="item channel_item dehradun">
									<i class="uil uil-location-point"></i>
	  							    <span onclick="setPincode('248001')">Dehradun</span>									
								</div>
								<div class="item channel_item" id="EnterManually" data-toggle="modal" onclick="reset_get_city()" data-target="#get_city">
									<i class="uil uil-location-point"></i>
	  							    <span id="currentCity" class="text-capitalize">Enter Manually</span>									
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
					<!-- <form id="searchFrm">
						<input type="hidden" id="getSearchStrRes" name="search">
					</form> -->
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
									<a href="{{url('/user/rewards')}}" class="item channel_item"><i class="uil uil-gift icon__1"></i>My Rewards</a>
									<a href="{{url('/user/wallet')}}" class="item channel_item"><i class="uil uil-usd-circle icon__1"></i>My Wallet</a>
									<a href="{{url('/user/address')}}" class="item channel_item"><i class="uil uil-location-point icon__1"></i>My Address</a>
									<!-- <a href="offers" class="item channel_item"><i class="uil uil-gift icon__1"></i>Offers</a> -->
									<!-- <a href="faq" class="item channel_item"><i class="uil uil-info-circle icon__1"></i>Faq</a> -->
									<a href="{{url('/user/logout')}}" class="item channel_item"><i class="uil uil-lock-alt icon__1"></i>Logout</a>
								</div>
							</li>
							@else
							<li>
								<a data-toggle="modal" data-target="#login_modal_home" onclick="login_modal_home_reset();" class="offer-link">Login<i class='uil uil-exit'></i></a>
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
									<li class="nav-item"><a href="{{url('/blogs')}}" class="nav-link @yield('blog_active')" title="Blog">Blog</a></li>	
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
		@section('container')
		@show      
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
									<li><a href="{{url('/about')}}">About Us</a></li>
									<li><a href="{{url('/featured-products')}}">Featured Products</a></li>
									<li><a href="{{url('/offers')}}">Offers</a></li>
									<li><a href="{{url('/blogs')}}">Blog</a></li>
									<li><a href="{{url('/faq')}}">Faq</a></li>
									<li><a href="{{url('/career')}}">Careers</a></li>
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
										  <img alt="Cash On Delivery" title="Cash On Delivery" src="{{asset('front_assets/images/footer-icons/pyicon-6.svg')}}">
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
									<li><a href="{{url('/about')}}">About</a></li>
									<li><a href="{{url('/contact')}}">Contact</a></li>
									<li><a href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
									<li><a href="{{url('/term-conditions')}}">Term & Conditions</a></li>
									<li><a href="{{url('/refund-return-policy')}}">Refund & Return Policy</a></li>
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
	</span>
</body>

<!-- Mirrored from gambolthemes.net/html-items/gambo_supermarket_demo/index by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 26 May 2020 11:40:15 GMT -->
</html>
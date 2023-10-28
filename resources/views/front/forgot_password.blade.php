﻿<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from gambolthemes.net/html-items/gambo_supermarket_demo/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 26 May 2020 11:44:56 GMT -->
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Gambo - Sign In</title>
		
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="{{asset('front_assets/images/fav.png')}}">
		
		<!-- Stylesheets -->
		<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
		<link href="{{asset('front_assets/vendor/unicons-2.0.1/css/unicons.css')}}" rel='stylesheet'>
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
		
	</head>

<body>
	<div class="sign-inup">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-5">
					<div class="sign-form">
						<div class="sign-inner">
							<div class="form-dt">
								<div class="form-inpts checout-address-step">
									<form id="resetPassword">
										@csrf
										<div class="form-title"><h6>Reset Your Password</h6></div>
										<div class="form-group pos_rel">
											<input id="password" name="password" type="password" placeholder="Enter New Password" class="form-control lgn_input" required="">
											<i class="uil uil-padlock lgn_icon"></i>
										</div>
										<div class="form-group pos_rel">
											<input id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm Password" class="form-control lgn_input" required="">
											<i class="uil uil-padlock lgn_icon"></i>
										</div>
										<input type="hidden" value="{{$token}}" name="token">
										<button class="login-btn hover-btn" id="cpass" type="submit">Reset Password</button>
									</form>
								</div>
								<div class="signup-link">
									<p>Go Back - <a href="{{url('/login')}}">Sign In Now <i class="fas fa-sign-in-alt"></i></a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Javascripts -->
	<script src="{{asset('front_assets/js/jquery-3.3.1.min.js')}}"></script>
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

<!-- Mirrored from gambolthemes.net/html-items/gambo_supermarket_demo/sign_in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 26 May 2020 11:44:56 GMT -->
</html>

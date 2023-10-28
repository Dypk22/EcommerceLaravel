<!DOCTYPE html>
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
							<div class="sign-logo" id="logo">
								<a href="/"><img src="{{asset('front_assets/images/dark-logo-1.svg')}}" alt=""></a>
								<a href="/"><img class="logo-inverse" src="{{asset('front_assets/images/dark-logo-1.svg')}}" alt=""></a>
							</div>
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
							<div class="form-dt mt-2">
								<div class="form-inpts checout-address-step">
									<form id="frmLogin">
										<div class="form-title"><h6>Sign In</h6></div>
										    <div class="form-group">
										        <input id="login_email" name="login_email" class="form-control" value="{{$login_email}}" placeholder="Email" required="" type="email">
										    </div> <!-- form-group// -->
										    <div class="form-group">
										        <input class="form-control" id="login_password" name="login_password" value="{{$login_pwd}}" placeholder="******" required="" type="password">
										    </div> <!-- form-group// -->                                      
										    <div class="row">	
								              	<label for="rememberme" class="rememberme form-group col-md-12 mb-4">
								              		<input type="checkbox" id="rememberme" name="rememberme" {{$is_remember}}> Remember me 
								              	</label>
												<div class="col-6">
										            <div class="form-group">
										                <button onclick="signinUser('home')" type="button" id="btnLogin" class="btn d-block custom_button">Sign In Now <i class="fas fa-sign-in-alt"></i></button>
										            </div> <!-- form-group// -->
										        </div>
										        <div class="col-6 text-right">
										        	<div class="password-forgor">
														<a href="#">Forgot Password?</a>
													</div>
										            <!-- <a class="small color-tomato" href="#">Forgot password?</a> -->
										        </div>  
										        <div id="login_msg" style="font-size: 14px; font-family: 'Roboto', sans-serif; display: none; margin-left: 15px" class="alert alert-danger mx-0 col-12" role="alert">
												  <strong>Alert!</strong> <span id="main_login_msg"></span>
												  <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												    <span aria-hidden="true">&times;</span>
												  </button> -->
												</div>	                                          
										    </div> <!-- .row// -->     
											@csrf                                                             
										</form>
								</div>
								@if(session('msg')!='')
								<div class="password-forgor">
				                <div style="margin-top: 30px; display: block;" class="custom_error">{{session('msg')}}</div>
								</div>
								@else
				                <div style="margin-top: 30px; display: block;" class="custom_error"></div>
								@endif
								<div class="signup-link">
									<p>Don't have an account? - <a href="register">Sign Up Now</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="copyright-text text-center mt-3">
						<i class="uil uil-copyright"></i>Copyright 2020 <b>Gambolthemes</b> . All rights reserved
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
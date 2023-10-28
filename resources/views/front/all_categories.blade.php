<!DOCTYPE html>
<html lang="en">

	
<!-- Mirrored from gambolthemes.net/html-items/gambo_supermarket_demo/index by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 26 May 2020 11:38:58 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, shrink-to-fit=9">
	<meta name="description" content="Gambolthemes">
	<meta name="author" content="Gambolthemes">		
    <title>Grockart | Get Choose From All Categories</title>
	
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
				
				<!-- <form id="searchFrm">
					<input type="hidden" id="getSearchStrRes" name="search">
				</form> -->
				<div class="header_right">
					<!-- <ul>
						<li>
							<a href="tel:{{$my_details[0]->mobile}}" class="offer-link"><i class="uil uil-phone-alt"></i>+91{{$my_details[0]->mobile}}</a>
						</li>
						<li>
							<a href="{{url('/offers')}}" class="offer-link"><i class="uil uil-gift"></i>Offers</a>
						</li>
						<li>
							<a href="{{url('/faq')}}" class="offer-link"><i class="uil uil-question-circle"></i>Help</a>
						</li>
					</ul> -->
					<nav class="navbar navbar-expand-lg navbar-light py-3">
						<div class="container-fluid">
							<button class="navbar-toggler menu_toggle_btn" type="button" data-target="#navbarSupportedContent"><i class="uil uil-bars"></i></button>
							<div class="collapse navbar-collapse d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end bg-dark1 p-3 p-lg-0 mt1-5 mt-lg-0 mobileMenu" id="navbarSupportedContent">
								<ul class="navbar-nav main_nav align-self-stretch">
									<li class="nav-item"><a href="/" class="nav-link @yield('home_active')" title="Home">Home</a></li>
									<li class="nav-item"><a href="{{url('/about')}}" class="nav-link @yield('about_active')" title="About Us">About</a></li>
									<li class="nav-item"><a href="{{url('/blogs')}}" class="nav-link @yield('blog_active')" title="Blog">Blog</a></li>	
									<li class="nav-item"><a href="{{url('/contact')}}" class="nav-link @yield('contact_active')" title="Contact">Contact Us</a></li>
								</ul>
							</div>
							<style type="text/css">
								@media(max-width: 768px){
									.mobileMenu{
									    margin-top: 60px !important;
									}
									.header_right ul li{
										display: block!important;
									}
								}
							</style>
						</div>
					</nav>
				</div>
			</div>
		</div>	
	</header>
	<!-- Header End -->
	<!-- Body Start -->
	<div class="wrapper">
		<div class="section145 pt-0">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main-title-tt">
							<div class="main-title-left">
								<span>All Categories</span>
								<h2>Grockart Grocceries Store</h2>
							</div>
							<!-- <a href="{{url('/featured-products')}}" class="see-more-btn">See All</a> -->
						</div>
					</div>
					<div class="container">
						<div class="row">
							<div class="col-md-10">
								<div class="footer-bottom-links">
									<ul>
										@foreach($categories as $categories)
										<li class="pb-2 px-1"><a style="font-size: 1rem !important;" href="{{url('/categories/'.$categories->category_slug)}}" class="text-capitalize">{{$categories->category_name}}</a></li>
										@endforeach
										@foreach($sub_categories as $sub_categories)
										<li class="pb-2 px-1"><a style="font-size: 1rem !important;" href="{{url('categories/personal-care?from=all&category=null&subcategory='.$sub_categories->subcategory_slug)}}" class="text-capitalize">{{$sub_categories->subcategory_name}}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
					</div>
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
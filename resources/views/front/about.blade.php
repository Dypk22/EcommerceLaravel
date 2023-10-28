@extends('front/layout')
@section('about_active','active')
@section('page_title','Know About Us - Grockart')
@section('container')
	<!-- Body Start -->
	<div class="wrapper">
		<div class="default-dt">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="default_tabs">
							<nav>
								<div class="nav nav-tabs tab_default  justify-content-center">
									<a class="nav-item nav-link active" href="about">About</a>
									<a class="nav-item nav-link" href="blogs">Blog</a>
									<a class="nav-item nav-link" href="career">Careers</a>
									<a class="nav-item nav-link" href="press">Press</a>
								</div>
							</nav>						
						</div>
						<div class="title129">	
							<h2>About Us</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="life-gambo">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="default-title left-text">
							<h2>Who We Are</h2>
							<p>Customers Deserve Better</p>
							<img src="{{asset('front_assets/images/line.svg')}}" alt="">
						</div>
						<div class="about-content">
							<p>
								Grockart is Haridwar’s leading online supermarket in the grocery space. We uses our in-house technology platform to manage a network of over 100+ partner stores that enable the company to run a fast and lean supply chain – from manufacturers & farms straight to customers. Our efficient & committed delivery team ready to deliver over 5 million+ products to customers every month.
							</p>
							<p>
								We source the highest quality products, including the freshest fruits & vegetables straight from the local growers, so that you can have the satisfaction of knowing you and your family are safe. Furthermore, due to the Covid-19 pandemic, we have installed a total contamination-proof system and follow strict safety protocols to ensure the safest possible process.
							</p>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="about-img">
							<img src="{{asset('front_assets/images/about.svg')}}" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="about-steps-group white-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<div class="about-step">
							<div class="about-step-img">
								<img src="{{asset('front_assets/images/about/icon-1.svg')}}" alt="">
							</div>
							<h4>100+</h4>
							<p>People have joined the Grockart team in the past month</p>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="about-step">
							<div class="about-step-img">
								<img src="{{asset('front_assets/images/about/icon-2.svg')}}" alt="">
							</div>
							<h4>Wide Product Range</h4>
							<p>Get all products direct to door on time everytime</p>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="about-step">
							<div class="about-step-img">
								<img src="{{asset('front_assets/images/about/icon-3.svg')}}" alt="">
							</div>
							<h4>Free Delivery</h4>
							<p>We provide free delivery across all orders</p>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="about-step">
							<div class="about-step-img">
								<img src="{{asset('front_assets/images/about/icon-4.svg')}}" alt="">
							</div>
							<h4>Great Discounts</h4>
							<p>Get Exclusive Offers on our app</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="life-gambo">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="default-title">
							<h2>Our Team</h2>
							<p>Teamwork Makes the Dream Work</p>
							<img src="{{asset('front_assets/images/line.svg')}}" alt="">
						</div>
						<div class="dd-content">
							<div class="owl-carousel team-slider owl-theme">
								<div class="item">
									<div class="team-item">
										<div class="team-img">
											<img src="{{asset('front_assets/images/team/img-1.jpg')}}" alt="">
										</div>
										<h4>Dypk Nawani</h4>
										<span>CEO & Founder</span>
										<ul class="team-social">
											<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-linkedin-in"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="item">
									<div class="team-item">
										<div class="team-img">
											<img src="{{asset('front_assets/images/team/img-2.jpg')}}" alt="">
										</div>
										<h4>John Doe</h4>
										<span>CTO & Senior Developer</span>
										<ul class="team-social">
											<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-linkedin-in"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="item">
									<div class="team-item">
										<div class="team-img">
											<img src="{{asset('front_assets/images/team/img-3.jpg')}}" alt="">
										</div>
										<h4>Jassica William</h4>
										<span>HR Manager</span>
										<ul class="team-social">
											<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-linkedin-in"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="item">
									<div class="team-item">
										<div class="team-img">
											<img src="{{asset('front_assets/images/team/img-4.jpg')}}" alt="">
										</div>
										<h4>Zoena Singh</h4>
										<span>Senior Sales Manager</span>
										<ul class="team-social">
											<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-linkedin-in"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="how-order-gambo">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="default-title">
							<h2>How Do I Order?</h2>
							<p>How Do I order on Grocer's</p>
							<img src="{{asset('front_assets/images/line.svg')}}" alt="">
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="how-order-steps">
							<div class="how-order-icon">
								<i class="uil uil-search"></i>
							</div>
							<h4>Browse Grockart.in & search the product</h4>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="how-order-steps">
							<div class="how-order-icon">
								<i class="uil uil-shopping-basket"></i>
							</div>
							<h4>Add item to your shopping basket</h4>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="how-order-steps">
							<div class="how-order-icon">
								<i class="uil uil-stopwatch"></i>
							</div>
							<h4>Choose a convenient delivery time from our 4 Slots* a day</h4>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="how-order-steps">
							<div class="how-order-icon">
								<i class="uil uil-money-bill"></i>
							</div>
							<h4>Select suitable payment option (Cash, Master, Credit Card, Discover & wallet)</h4>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="how-order-steps">
							<div class="how-order-icon">
								<i class="uil uil-truck"></i>
							</div>
							<h4>Your products will be home-delivered as per your order.</h4>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="how-order-steps">
							<div class="how-order-icon">
								<i class="uil uil-smile"></i>
							</div>
							<h4>Happy Customers</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Body End -->
@endsection
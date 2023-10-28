@extends('front/layout')
@section('about_active','')
@section('page_title','Grockart | Press, Media & Others')
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
									<a class="nav-item nav-link" href="about_us">About</a>
									<a class="nav-item nav-link" href="our_blog">Blog</a>
									<a class="nav-item nav-link" href="career">Careers</a>
									<a class="nav-item nav-link active" href="press">Press</a>
								</div>
							</nav>						
						</div>
						<div class="title129">	
							<h2>Press Releases</h2>						
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="blog-gambo">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-5">
						<div class="fcrse_3">
							<ul class="blogleft12">
								<li>
									<a href="#collapse2" class="category-topics cate-right" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapse2">Archive News</a>
									<div class="collapse show" id="collapse2" style="">
										<ul class="category-card">
											<li>
												<a href="#" class="category-item1">2020</a>																																																																																																																						
											</li>																												
										</ul>
									</div>
								</li>
								<li>
									<div class="socl148">
										<button class="twiter158" data-href="#" onclick="sharingPopup(this);" id="twitter-share"><i class="uil uil-twitter ic45"></i>Follow</button>
										<button class="facebook158" data-href="#" onclick="sharingPopup(this);" id="facebook-share"><i class="uil uil-facebook ic45"></i>Follow</button>
									</div>
								</li>
								<li>
									<div class="help_link">
										<a href="#">FAQ Help Center</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-8 col-md-7">
						<div class="press-title">
							<h2>Gambo in the News</h2>
							<p>For media interviews and inquiries, please send an email to <a href="#">press@gambosupermarket.com</a></p>
						</div>
						<a href="#" class="press-item">
							<span>May 15, 2020</span>
							<h4>Live Mint</h4>
							<p>Gambo delivery the goods</p>
						</a>
						<a href="#" class="press-item">
							<span>May 12, 2020</span>
							<h4>Business Standred</h4>
							<p>Gambo targets $20 million revenue in 2020</p>
						</a>
						<a href="#" class="press-item">
							<span>May 8, 2020</span>
							<h4>Tech Asia</h4>
							<p>Gambo’s secret to handling 5,000 orders a day</p>
						</a>
						<a href="#" class="press-item">
							<span>May 5, 2020</span>
							<h4>Your Story</h4>
							<p>Ludhiana-based online grocery firm gambo is set to create an organic revolution in india</p>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Body End -->
@endsection
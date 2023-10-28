@extends('front/layout')
@section('blog_active','active')
@section('page_title','Grockart | Blogs')
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
									<a class="nav-item nav-link" href="about">About</a>
									<a class="nav-item nav-link active" href="blogs">Blog</a>
									<a class="nav-item nav-link" href="career">Careers</a>
									<a class="nav-item nav-link" href="press">Press</a>
								</div>
							</nav>						
						</div>
						<div class="title129">	
							<h2>Insights, ideas, and stories</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="blog-gambo">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-5">
						<div class="pdpt-bg mt-0">
							<div class="pdpt-title">
								<h4>Most Viewed Posts</h4>
							</div>
							<ul class="top-posts">
								<li>
									<div class="blog-top-item">
										<a href="#" class="top-post-link">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
										<span class="blog-time">8 May, 2020</span>
									</div>
								</li>
								<li>
									<div class="blog-top-item">
										<a href="#" class="top-post-link">Vestibulum venenatis sem eu venenatis vulputate.</a>
										<span class="blog-time">7 May, 2020</span>
									</div>
								</li>
								<li>
									<div class="blog-top-item">
										<a href="#" class="top-post-link">In ac diam vitae ex luctus viverra eu eu quam.</a>
										<span class="blog-time">4 May, 2020</span>
									</div>
								</li>
								<li>
									<div class="blog-top-item">
										<a href="#" class="top-post-link">Nullam commodo felis sed lacus lobortis ullamcorper.</a>
										<span class="blog-time">3 May, 2020</span>
									</div>
								</li>
								<li>
									<div class="blog-top-item">
										<a href="#" class="top-post-link">Aenean vel ligula pulvinar, ornare urna sed, luctus lacus.</a>
										<span class="blog-time">2 May, 2020</span>
									</div>
								</li>
							</ul>
						</div>
						<div class="pdpt-bg mb-30">
							<div class="pdpt-title">
								<h4>Contact With Us</h4>
							</div>
							<div class="cntct-social">
								<ul class="team-social">
									<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-instagram"></i></a></li>
									<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-linkedin-in"></i></a></li>
									<li><a href="#" class="scl-btn hover-btn"><i class="fab fa-youtube"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-7">
						@foreach($blog as $blog)
						<div class="blog-item">
							<a href="{{url('/blogs/'.$blog->slug)}}" class="blog-img">
								<img src="{{asset('storage/blog/'.$blog->blog_img)}}" alt="">
								<div class="blog-cate-badge">{{$blog->blog_cat}}</div>
							</a>
							<div class="date-icons-group">
								<div class="blog-time sz-14">{{$blog->added_on}}</div>
								<ul class="like-share-icons">
									<li>
										@php
										if(session()->has('FRONT_USER_LOGIN')){
								            $uid=session()->get('FRONT_USER_ID');
								            $uname=session()->get('FRONT_USER_NAME');
								        }else{
								            $uid=0;
								            $uname='null';
								        }
										@endphp
										<a class="like-share"><i class="uil uil-thumbs-up" onclick="blog_like('{{$uid}}','{{$blog->id}}','{{$uname}}')"></i><span id="blog_like{{$blog->id}}">{{$blog->blog_like}}</span></a>
									</li>
									<li>
										<a class="like-share"><i class="uil uil-share-alt"></i></a>
									</li>
								</ul>
							</div>
							<div class="blog-detail">
								<h4>{{$blog->blog_heading}}</h4>
								<p>{{$blog->blog_shortdesc}}</p>
								<a href="{{url('/blogs/'.$blog->slug)}}">Read More</a>
							</div>
						</div>
						@endforeach
						<div class="blog-more-btn">
							<a href="{{url('/blogs/'.$blog->slug)}}" class="blog-btn hover-btn">More View</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Body End -->
@endsection
@extends('front/layout')
@section('blog_active','active')
@section('page_title', 'Grockart | Blogs - '.ucwords($blogDetail[0]->blog_heading))
@section('container')
	<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">Home</a></li>
								<li class="breadcrumb-item"><a href="{{url('/blogs')}}">Our Blogs</a></li>
								<li class="breadcrumb-item active" aria-current="page">Blog-Detail</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="blog-dt-vw banner-blog banner.visible parallax" style="background: url({{asset('storage/blog/'.$blogDetail[0]->blog_img)}}) 40% 0px / cover no-repeat;">
			<div class="blog-inner">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h1 class="text-capitalize">{{$blogDetail[0]->blog_heading}}</h1>
							<div class="extra-info">
								<span class="entry-date">{{$blogDetail[0]->added_on}}</span>
								<div class="single-post-cat">
									<a href="#">{{$blogDetail[0]->blog_cat}}</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="blog-single-dts-text">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-10">
						<div class="bb-des12">
							<div class="blog-des-dt142">
								<p>{{$blogDetail[0]->blog_shortdesc}}</p>
								<ul class="joby-list-dt mt-21">
									@php 
									 $benefit_1 = $blogDetail[0]->benefit_1; 
									 $benefit_2 = $blogDetail[0]->benefit_2; 
									 $benefit_3 = $blogDetail[0]->benefit_3; 
									 $benefit_4 = $blogDetail[0]->benefit_4; 
									 $benefit_5 = $blogDetail[0]->benefit_5; 
									 $benefit_6 = $blogDetail[0]->benefit_6; 
									 $benefit_7 = $blogDetail[0]->benefit_7; 
									 $benefit_8 = $blogDetail[0]->benefit_8; 
									 $benefit_9 = $blogDetail[0]->benefit_9; 
									 $benefit_10 =$blogDetail[0]->benefit_10; 
									 @endphp
									
									@php  if($benefit_1!=''){ @endphp
									<li><p class="text-capitalize">{{ $benefit_1 }}</p></li>
									@php  } @endphp

									@php  if($benefit_2!=''){ @endphp
									<li><p class="text-capitalize">{{ $benefit_2 }}</p></li>
									@php  } @endphp

									@php  if($benefit_3!=''){ @endphp
									<li><p class="text-capitalize">{{ $benefit_3 }}</p></li>
									@php  } @endphp

									@php  if($benefit_4!=''){ @endphp
									<li><p class="text-capitalize">{{ $benefit_4 }}</p></li>
									@php  } @endphp

									@php  if($benefit_5!=''){ @endphp
									<li><p class="text-capitalize">{{ $benefit_5 }}</p></li>
									@php  } @endphp

									@php  if($benefit_6!=''){ @endphp
									<li><p class="text-capitalize">{{ $benefit_6 }}</p></li>
									@php  } @endphp

									@php  if($benefit_7!=''){ @endphp
									<li><p class="text-capitalize">{{ $benefit_7 }}</p></li>
									@php  } @endphp

									@php  if($benefit_8!=''){ @endphp
									<li><p class="text-capitalize">{{ $benefit_8 }}</p></li>
									@php  } @endphp

									@php  if($benefit_9!=''){ @endphp
									<li><p class="text-capitalize">{{ $benefit_9 }}</p></li>
									@php  } @endphp

									@php  if($benefit_10!=''){ @endphp
									<li><p class="text-capitalize">{{ $benefit_10 }}</p></li>
									@php  } @endphp									

								</ul>
								<p class="mt-21">{{$blogDetail[0]->blog_content}}</p>
							</div>
							<div class="date-icons-group vew1458">
								<div class="blog-time sz-14"></div>
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
										<a class="like-share ss18"><i class="uil uil-thumbs-up" onclick="blog_like('{{$uid}}','{{$blogDetail[0]->id}}','{{$uname}}')"></i><span id="blog_like">{{$blogDetail[0]->blog_like}}</span></a>
									</li>
									<li>
										<a href="#" class="like-share ss18"><i class="uil uil-share-alt"></i></a>
									</li>
								</ul>
							</div>
							<div class="all-comment">
								<h2>Comments {{$commentCount}}</h2>
								@foreach($blogComment as $blogComment)
								<div class="cmmnt_item">
									<div class="cmmnt_usr_dt">
										<img src="{{asset('front_assets/images/avatar/img-1.jpg')}}" alt="">
										<div class="rv1458">
											<h4 class="tutor_name1 text-capitalize">{{$blogComment->user_name}}</h4>
											<span class="time_145">{{date('d M, Y @ h:ia', strtotime($blogComment->added_on))}}</span>
										</div>
									</div>
									<p class="rvds10 text-capitalize">{{$blogComment->blog_comment}}</p>
								</div>
								@endforeach
							</div>
							<div class="leave-comment">
								<h2>Leave a Reply</h2>
								<span>Your email address and phone number will not be published. Required fields are marked *</span>
								<form id="frmCommentBlog" method="post">	
									<div class="row">
										@if(session()->has('FRONT_USER_LOGIN'))
										@else
										<div class="col-lg-4">
											<div class="form-group mt-1">
												<label class="control-label">Full Name*</label>
												<div class="ui search focus">
													<div class="ui left icon input swdh11 swdh19">
														<input class="prompt srch_explore" type="text" name="fullname" value="" id="name" required="" maxlength="64" placeholder="Your Full Name">															
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group mt-1">
												<label class="control-label">Email Address*</label>
												<div class="ui search focus">
													<div class="ui left icon input swdh11 swdh19">
														<input class="prompt srch_explore" type="email" name="emailaddress" value="" id="email" required="" placeholder="Your Email Address">															
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group mt-1">
												<label class="control-label">Phone Number*</label>
												<div class="ui search focus">
													<div class="ui left icon input swdh11 swdh19">
														<input class="prompt srch_explore" type="number" name="phonenumber" value="" id="number" required="" placeholder="Your Phone Number">															
													</div>
												</div>
											</div>
										</div>
										@endif
										<div class="col-lg-12">
											<div class="form-group mt-1">	
												<div class="field">
													<label class="control-label">Add Comment*</label>
													<textarea rows="5" class="form-control" style="resize: none;" required="" name="message" placeholder="Add your comment"></textarea>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<button class="post-btn hover-btn" id="CommentBtn" type="submit">Post Comment</button>
											<input type="hidden" value="{{$blogDetail[0]->id}}" id="blogId" name="blogId">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Body End -->
@endsection
@extends('front/layout')
@section('blog_active','')
@section('page_title','Offers Detail | '.$offerDetail[0]->tagline)
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
									<a class="nav-item nav-link active" href="{{url()->previous()}}">Back to Offers</a>
									<!-- <a class="nav-item nav-link" href="career">Careers</a> -->
									<!-- <a class="nav-item nav-link" href="press">Press</a> -->
								</div>
							</nav>						
						</div>
						<div class="title129">
							<h2 style="margin-top:30px !important;margin-bottom:0px !important;text-transform: uppercase;">📢📢 {{$offerDetail[0]->tagline}}</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="blog-gambo">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-5">
						<div class="pdpt-bg mt-0 pb-3">
							<div class="pdpt-title">
								<h4>Contact With Us</h4>
							</div>
							<div class="cntct-social">
								<ul class="team-social">
									<li><a href="" class="scl-btn hover-btn"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="" class="scl-btn hover-btn"><i class="fab fa-twitter"></i></a></li>
									<li><a href="" class="scl-btn hover-btn"><i class="far fa-envelope"></i></a></li>
									<li><a href="" class="scl-btn hover-btn"><i class="fab fa-instagram"></i></a></li>
									<li><a href="" class="scl-btn hover-btn"><i class="fab fa-linkedin-in"></i></a></li>
									<!-- <li><a href="#" class="scl-btn hover-btn"><i class="fab fa-youtube"></i></a></li> -->
								</ul>
							</div>
						</div>
						<div class="pdpt-bg mb-30">
							<div class="pdpt-title">
								<h4>How to Redeem</h4>
							</div>
							<ul class="joby-list-dt blog-detail pt-3">
									@php 
										$step1='';
										$step2='';
										$step3='';
										$step4='';
									@endphp
									@php  
									$step1=$offerDetail[0]->step1;
									if($step1!=''){ @endphp
									<li><p class="text-capitalize">{{ $step1 }}</p></li>
									@php  } @endphp

									@php  
									$step2=$offerDetail[0]->step2;
									if($step2!=''){ @endphp
									<li><p class="text-capitalize">{{ $step2 }}</p></li>
									@php  } @endphp

									@php  
									$step3=$offerDetail[0]->step3;
									if($step3!=''){ @endphp
									<li><p class="text-capitalize">{{ $step3 }}</p></li>
									@php  } @endphp

									@php 
									$step4=$offerDetail[0]->step4;
									if($step4!=''){ @endphp
									<li><p class="text-capitalize">{{ $step4 }}</p></li>
									@php  } @endphp					

								</ul>								
							<br>							
						</div>
					</div>
					<div class="col-lg-8 col-md-7">
						<div class="blog-item">
							<a class="blog-img">
								<img src="{{asset('storage/offers/'.$offerDetail[0]->img)}}" alt="">
								<!-- <div class="blog-cate-badge"><?php //echo $all_blogs['img']; ?></div> -->
							</a><br>
							<div class="blog-detail">
								<h4 class="text-capitalize">{{$offerDetail[0]->short_desc}}</h4>
								<p>{{$offerDetail[0]->description}}</p>
							</div>
							<div class="blog-detail">
								<h6 class="text-capitalize">TERMS & CONDITIONS</h6>
								<p><?php //echo $all_blogs['description']; ?></p>
								<ul class="joby-list-dt">
									@php 
									$terms1='';
									$terms2='';
									$terms3='';
									$terms4='';
									$terms5='';
									$terms6='';
									@endphp

									@php 
									$terms1=$offerDetail[0]->terms1;
									if ($terms1!='') {
									@endphp 
									<li><p>{{ $terms1 }}</p></li>
									@php 
									}
									$terms2=$offerDetail[0]->terms2;
									if ($terms2!='') {
									@endphp 
									<li><p>{{ $terms2 }}</p></li>
									@php 
									}
									$terms3=$offerDetail[0]->terms3;
									if ($terms3!='') {
									@endphp 
									<li><p>{{ $terms3 }}</p></li>
									@php 
									}
									$terms4=$offerDetail[0]->terms4;
									if ($terms4!='') {
									@endphp 
									<li><p>{{ $terms4 }}</p></li>
									@php 
									}
									$terms5=$offerDetail[0]->terms5;
									if ($terms5!='') {
									@endphp 
									<li><p>{{ $terms5 }}</p></li>
									@php 
									}
									$terms6=$offerDetail[0]->terms6;
									if ($terms6!='') {
									@endphp 
									<li><p>{{ $terms6 }}</p></li>
									@php 
									}
									@endphp 
									
									<li><p>Coupon is only valid on <em>paynow</em> payment option.</p></li>
									<li><p>Grockart reserves the right to disqualify any Grockart Account from the benefits of this offer in case of any illegal, suspicious, fraudulent, or potentially fraudulent transaction/activity or misuse of the Offer.</p></li>
									<li><p>Grockart reserves the right to modify/change all or any of the terms applicable to this offer or discontinue this offer without assigning any reasons or without any prior intimation whatsoever.</p></li>
									<li><p>In case of any disputes, Grockart’s decision shall be final.</p></li>
									<li><p>This offer is also subject to Grockart Terms & Conditions available on the Grockart website.</p></li>
									<li><p>If you have any other queries, please visit the Help & Support section on Grockart platform.</p></li>
								</ul>
							</div>							
						</div>
						<?php //} ?>
						<!-- <div class="blog-more-btn">
							<a href="#" class="blog-btn hover-btn">More View</a>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Body End -->
@endsection
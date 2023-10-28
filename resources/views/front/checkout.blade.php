@extends('front/layout')
@section('home_active','')
@section('page_title','Grockart | Complete Order - Checkout')
@section('container')
	<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Checkout</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="all-product-grid">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-5">
						<div class="pdpt-bg mt-0">
							<div class="pdpt-title after_order">
								<h4>Order Summary</h4>
							</div>
							<div class="right-cart-dt-body">
								@php
								$getAddToCartTotalItem=getAddToCartTotalItem();
								$totalCartItem=count($getAddToCartTotalItem);
								$totalPrice=0;
								$totalMRP=0;
								$totalSaving=0;
				                $initial1=0;
				                @endphp
								@foreach($getAddToCartTotalItem as $only)
				                @php
				                $initial1+=($only->qty*$only->mrp);
				                @endphp
				                @endforeach
								@foreach($getAddToCartTotalItem as $cartItem)
				                @php
				                $totalPrice=$totalPrice+($cartItem->qty*$cartItem->price);
				                $totalMRP=$totalMRP+($cartItem->qty*$cartItem->mrp);
				                $totalSaving = $totalMRP - $totalPrice;
				                @endphp
								<div class="cart-item deleteFromCartPage border_radius">
									<div class="cart-product-img">
										<img src="{{asset('storage/ProductsImage/'.$cartItem->image1)}}" alt="">
										<div class="offer-badge">{{$cartItem->discount}}% OFF</div>
									</div>
									<div class="cart-text">
										@php $roduct_name_substring = explode(' ', $cartItem->name); $link=url('products/'.$cartItem->slug); @endphp
										@if(count($roduct_name_substring)==1)
										<h4 onclick='window.location.href="{{$link}}"' class="text-capitalize custom_hover mb-1">{{$roduct_name_substring[0]}}</h4>
										@elseif(count($roduct_name_substring)==2)
										<h4 onclick='window.location.href="{{$link}}"' class="text-capitalize custom_hover mb-1">{{$roduct_name_substring[0].' '.$roduct_name_substring[1]}}</h4>
										@elseif(count($roduct_name_substring)==3)
										<h4 onclick='window.location.href="{{$link}}"' class="text-capitalize custom_hover mb-1">{{$roduct_name_substring[0].' '.$roduct_name_substring[1].' '.$roduct_name_substring[2]}}</h4>
										@else
											@if(count($roduct_name_substring)>3)
											<h4 onclick='window.location.href="{{$link}}"' class="text-capitalize custom_hover mb-1">{{$roduct_name_substring[0].' '.$roduct_name_substring[1].' '.$roduct_name_substring[2].' ...'}}</h4>
											@endif
										@endif
										<div class="d-block my-2">
											<span class="custom_badge">{{$cartItem->weight}}</span>
										</div>
										<div class="cart-item-price">₹{{$cartItem->price}} <span>₹{{$cartItem->mrp}}</span><span style="font-size: 12px; color: #3e3f5c; text-decoration: none;"> X {{$cartItem->qty}} Qty</span></div>
										<button type="button" class="cart-close-btn"  onclick="deleteFromCartPage('{{$cartItem->pid}}')";><i class="uil uil-multiply"></i></button>
									</div>		
								</div>
				                @endforeach
							</div>
							<div class="total-checkout-group">
								<div class="cart-total-dil">
									<h4>Gambo Super Market</h4>
									<span class="carttotalMRP">₹{{$initial1}}</span>
								</div>
								<div class="cart-total-dil pt-3">
									<h4>Delivery Charges</h4>
									<span>Free <del>₹49</del></span>
								</div>
							</div>
							<div class="cart-total-dil saving-total">
								<h4>Total Saving</h4>
								<span class="carttotalSaving">₹{{$totalSaving}}</span>
							</div>
							<div class="main-total-cart">
								<h2>Total</h2>
								<span class="carttotalPrice" data-position="bottom center" data-tooltip="₹{{$totalPrice}}">₹{{$totalPrice}}</span>
							</div>
							<div class="payment-secure">
								<a href="{{url('order-daily')}}" class="text-dark"><i class="uil uil-question-circle"></i>Need This Daily</a>
							</div>
						</div>
						<a class="promo-link45" data-toggle="collapse" href="#applyCoupon">Have a promocode?</a>
						<form class="collapse" id="applyCoupon">
							<div class="promo-link45" style="margin-top: 15px;padding: 20px 0px 15px 0px;">
								<div class="col-lg-12">
									<div class="input-group mb-2">
									  <input type="text" class="form-control custom_input" id="coupon_code" name="coupon_code" placeholder="Enter Coupon">
									  <button class="chck-btn hover-btn" type="button" id="submitBtn" style="border: none;" onclick="applyCouponCode()">Apply</button>
									  <button class="chck-btn hover-btn" type="button" id="removeBtn" style="border: none; display: none;" onclick="removeCouponCode()">Remove</button>
									</div>
								</div>
								<!-- <div id="coupon_error" class="alert custom_alert mt-3 mx-auto col-10" role="alert"> -->
								  <!-- <span id="coupon_error_msg"></span> -->
								  <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> -->
								    <!-- <span aria-hidden="true">&times;</span> -->
								  <!-- </button> -->
								<!-- </div>	 -->
							</div>
							@csrf
						</form>
						<div class="checkout-safety-alerts">
							<p><i class="uil uil-padlock"></i>Secure checkout</p>
							<p><i class="uil uil-sync"></i>100% Replacement Guarantee</p>
							<p><i class="uil uil-check-square"></i>100% Genuine Products</p>
							<p><i class="uil uil-shield-check"></i>Secure Payments</p>
						</div>
					</div>
					<div class="col-lg-8 col-md-7">
						<div id="checkout_wizard" class="checkout accordion left-chck145">
							@php $temp='';@endphp
							@if(session()->has('FRONT_USER_LOGIN')==null)
							<div class="checkout-step" id="FirstPlace">
								@php $temp='ok';@endphp
								<div class="checkout-card" id="headingFirst"> 
									<span class="checkout-step-number">!</span>
									<h4 class="checkout-step-title"> 
										<button class="wizard-btn" type="button" data-toggle="collapse" data-target="#collapseFirst" aria-expanded="true" aria-controls="collapseFirst"> Yor're not signed in!</button>
									</h4>
								</div>
								<div id="collapseFirst" class="collapse in show" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<!-- <p class="ml-3">You are currently not login into your Grockart account.</p> -->
										<p class="ml-3"><a data-toggle="modal" data-target="#login_modal" class="color-tomato" href="javascript:void(0)">Click here to sign in</a> or <a role="button" data-toggle="collapse" data-parent="#checkout_wizard" onclick="continueCollapse()" class="color-tomato">Continue</a></p>	
										<!-- <p class="phn145"><a class="edit-no-btn hover-btn"  role="button" data-toggle="collapse" data-parent="#checkout_wizard"  href="#collapseOne">Continue</a><a class="edit-no-btn hover-btn" data-toggle="modal" data-target="#login_modal" href="javascript:void(0)">Login</a></p> -->

									</div>
								</div>
							</div>
							@endif()
							@php if($temp!='ok'){$temp='show';}
							@endphp 
							<div class="checkout-step">
								<div class="checkout-card" id="headingOne"> 
									<span class="checkout-step-number">1</span>
									<h4 class="checkout-step-title"> 
										<button class="wizard-btn" disabled="" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="collapseOneHead">Contact Detail</button>
									</h4>
								</div>
								<div id="collapseOne" class="collapse in @php echo $temp; @endphp" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<p>We need your phone number so we can inform you about any delay or problem.</p>	
										<p class="phn145"> 
											@if(isset($reg_customer_mobile))
											Is this mobile number correct? <br>
											<span class="ml-1">+91-{{$reg_customer_mobile}} </span> 
											<a class="edit-no-btn hover-btn" data-toggle="collapse" href="#edit-number">Edit</a>
											<div class="collapse" id="edit-number">
												<div class="row">
													<div class="col-lg-8">
														<div class="checkout-login mb-4">
															<div class="login-phone">
																<input type="text" id="buyer_new_umber" class="form-control" placeholder="Phone Number">
															</div>
															<!-- <a class="chck-btn hover-btn" role="button" data-toggle="collapse" href="#otp-verifaction" >Send Code</a> -->
														</div>
													</div>
												</div>
											</div>
											<div>
												<a class="collapsed chck-btn hover-btn" role="button" data-toggle="collapse" data-parent="#checkout_wizard" onclick="checkoutForm11('{{$reg_customer_mobile}}')">Next</a>
											</div>
											@else
											Enter mobile number to proceed
											<div class="row">
												<div class="col-lg-8">
													<div class="checkout-login">
														<form>
															<div class="login-phone">
																<input type="number" class="form-control" id="buyer_mobile" placeholder="Phone Number">
															</div>
															<!-- <a class="chck-btn hover-btn" role="button" data-toggle="collapse" href="#otp-verifaction" >Send Code</a> -->
															<a class="collapsed text-light chck-btn hover-btn" role="button" data-toggle="collapse" data-parent="#checkout_wizard" onclick="checkoutForm1()">Next</a>
														</form>
													</div>
												</div>
											</div>
											@endif
										</p>
									</div>
								</div>
							</div>
							<div class="checkout-step">
								<div class="checkout-card" id="headingTwo">
									<span class="checkout-step-number">2</span>
									<h4 class="checkout-step-title">
										<button class="wizard-btn collapsed" id="collapseTwoHead" disabled="" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Delivery Address</button>
									</h4>
								</div>
								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<div class="checout-address-step">
											<div class="row">
												<div class="col-lg-12">												
													<form class="">
														<!-- Multiple Radios (inline) -->
														<div class="form-group">
															<div class="product-radio">
																<ul class="product-now">
																	<li>
																		<input type="radio" id="ad1" onclick="address_type('home')" checked=""name="address1">
																		<label for="ad1">Home</label>
																	</li>
																	<li>
																		<input type="radio" id="ad2" onclick="address_type('office')" name="address1">
																		<label for="ad2">Office</label>
																	</li>
																	<li>
																		<input type="radio" id="ad3" onclick="address_type('other')" name="address1">
																		<label for="ad3">Other</label>
																	</li>
																</ul>
															</div>
														</div>
														<div class="address-fieldset">
															<div class="row">
																@if(count($prevOrder)>0)
																<div class="col-md-12">
																	<div class="form-group">
																		<label class="control-label">Name*</label>
																		<input id="buyername" name="name" type="text" placeholder="Full Name" class="form-control input-md" required="">
																	</div>
																</div>
																@else
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Name*</label>
																		<input id="buyername" name="name" type="text" placeholder="Full Name" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Email*</label>
																		<input id="buyeremail" name="buyeremail" type="email" placeholder="Email" class="form-control input-md" required="">
																	</div>
																</div>
																@endif
																<div class="col-lg-12 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Flat / House / Office No.*</label>
																		<input id="buyeradd1" name="flat" type="text" placeholder="Address" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-lg-12 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Street / Society / Office Name*</label>
																		<input id="buyeradd2" name="street" type="text" placeholder="Street Address" class="form-control input-md">
																	</div>
																</div>
																<div class="col-lg-4 col-md-12">
																	<div class="form-group">
																		<label class="control-label">City*</label>
																		<input id="buyercity" name="city" type="text" placeholder="Enter City" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-lg-4 col-md-12">
																	<div class="form-group">
																		<label class="control-label">State*</label>
																		<input id="buyerstate" name="state" type="text" placeholder="Enter State" class="form-control input-md" required="">
																	</div>
																</div>
																<div class="col-lg-4 col-md-12">
																	<div class="form-group">
																		<label class="control-label">Pincode*</label>
																		<input id="buyerpincode" name="pincode" type="text" placeholder="Pincode" class="form-control input-md" required="">
																	</div>
																</div>
																
															</div>
														</div>
														@if(count($prevOrder)>0 && isset($customer_info[0]))
														<div class="form-group">
															<div class="product-radio">
																<ul class="product-now">
																	<h5 class="checkout-step-title" style="margin-top: 18px;">Or Select Any Address</h5>
																</ul>
															</div>
														</div>
															@php $i=0; @endphp
															@foreach($customer_info as $customer_info)
															<div class="ui col-md-12 radio checkbox chck-rdio mb-2">
																<input type="radio" id="{{$i}}" name="fruit" tabindex="0" class="hidden">
																<label onclick="selectAddress('{{$customer_info->name}}', '{{$customer_info->main_address}}', '{{$customer_info->street}}', '{{$customer_info->city}}', '{{$customer_info->state}}', '{{$customer_info->pincode}}')" for="{{$i}}" class="text-capitalize">{{$customer_info->name}}, {{$customer_info->main_address}}, {{$customer_info->street}}, {{$customer_info->city}}, {{$customer_info->state}}, {{$customer_info->pincode}}</label>
															</div>
															@php $i++; @endphp
															@endforeach
														@endif
														<div class="address-fieldset mt-3">
															<div class="row">
																<div class="col-lg-9 px-0 col-md-9 col-8">
																	<div id="checkout_msg" style="font-size: 14px; font-family: 'Roboto', sans-serif; display: none; margin-left: 15px" class="alert alert-danger pr-0 col-10" role="alert">
																	  <span id="checkout_main_msg"></span>
																	</div>
																</div>
																<div class="col-lg-3 col-md-3 col-4">
																	<div class="form-group">
																		<div class="address-btns">
																			<!-- <button class="save-btn14 hover-btn">Save</button> -->
																			<a class="collapsed ml-auto text-light next-btn16 hover-btn" onclick="checkoutForm2()" role="button" data-toggle="collapse" data-parent="#checkout_wizard"> Next </a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="checkout-step">
								<div class="checkout-card" id="headingThree"> 
									<span class="checkout-step-number">3</span>
									<h4 class="checkout-step-title">
										<button class="wizard-btn collapsed" id="collapseThreeHead" disabled="" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Delivery Time & Date </button>
									</h4>
								</div>
								<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label">Select Date and Time*</label>
													<div class="date-slider-group">
														<div class="owl-carousel date-slider owl-theme">
															<div class="item">
																<div class="date-now">
																	<input type="radio" value='<?php echo date("Y-m-d"); ?>' id="dd1" name="delivery_date" checked="">
																	<label for="dd1">Today</label>
																</div>
															</div>
															<div class="item">
																<div class="date-now">
																	<input type="radio" value='<?php echo date("Y-m-d", strtotime('+1 days')); ?>' id="dd2" name="delivery_date">
																	<label for="dd2">Tomorrow</label>
																</div>
															</div>
															<div class="item">
																<div class="date-now">
																	<input type="radio" value='<?php echo date("Y-m-d", strtotime('+2 days')); ?>' id="dd3" name="delivery_date">
																	<label for="dd3"><?php echo date("d M, Y", strtotime('+2 days')); ?></label>
																</div>
															</div>
															<div class="item">
																<div class="date-now">
																	<input type="radio" value='<?php echo date("Y-m-d", strtotime('+3 days')); ?>' id="dd4" name="delivery_date">
																	<label for="dd4"><?php echo date("d M, Y", strtotime('+3 days')); ?></label>
																</div>
															</div>
															<div class="item">
																<div class="date-now">
																	<input type="radio" value='<?php echo date("Y-m-d", strtotime('+4 days')); ?>' id="dd5" name="delivery_date">
																	<label for="dd5"><?php echo date("d M, Y", strtotime('+4 days')); ?></label>
																</div>
															</div>
															<div class="item">
																<div class="date-now">
																	<input type="radio" value='<?php echo date("Y-m-d", strtotime('+5 days')); ?>' id="dd6" name="delivery_date">
																	<label for="dd6"><?php echo date("d M, Y", strtotime('+5 days')); ?></label>
																</div>
															</div>
															<div class="item">
																<div class="date-now">
																	<input type="radio" value='<?php echo date("Y-m-d", strtotime('+6 days')); ?>' id="dd7" name="delivery_date">
																	<label for="dd7"><?php echo date("d M, Y", strtotime('+6 days')); ?>/label>
																</div>
															</div>
															<div class="item">
																<div class="date-now">
																	<input type="radio" value='<?php echo date("Y-m-d", strtotime('+7 days')); ?>' id="dd8" name="delivery_date">
																	<label for="dd8"><?php echo date("d M, Y", strtotime('+7 days')); ?></label>
																</div>
															</div>
														</div>
													</div>
													<div class="time-radio">
														<div class="ui form">
															<div class="grouped fields">
																<div class="field">
																	<div class="ui radio checkbox chck-rdio">
																		<input type="radio" name="delivery_time" checked="" id="slot1" value='slot1' tabindex="0" class="hidden">
																		<label for="slot1">6AM - 8AM</label>
																	</div>
																</div>
																<div class="field">
																	<div class="ui radio checkbox chck-rdio">
																		<input type="radio" id="slot2" name="delivery_time" value='slot2' tabindex="0" class="hidden">
																		<label for="slot2">8AM - 10AM</label>
																	</div>
																</div>
																<div class="field">
																	<div class="ui radio checkbox chck-rdio">
																		<input type="radio" id="slot3" name="delivery_time" value='slot3' tabindex="0" class="hidden">
																		<label for="slot3">10AM - 12PM</label>
																	</div>
																</div>
																<div class="field">
																	<div class="ui radio checkbox chck-rdio">
																		<input type="radio" id="slot4" name="delivery_time" value='slot4' tabindex="0" class="hidden">
																		<label for="slot4">4PM - 6PM</label>
																	</div>
																</div>
																<div class="field">
																	<div class="ui radio checkbox chck-rdio">
																		<input type="radio" id="slot5" name="delivery_time" value='slot5' tabindex="0" class="hidden">
																		<label for="slot5">6PM - 8PM</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<a class="collapsed next-btn16 hover-btn" role="button" data-toggle="collapse" onclick="delivery_schedule()" href="#collapseFour"> Proccess to payment </a>
									</div>
								</div>
							</div>
							<div class="checkout-step">
								<div class="checkout-card" id="headingFour">
									<span class="checkout-step-number">4</span>
									<h4 class="checkout-step-title"> 
										<button class="wizard-btn collapsed"  id="collapsefourHead" disabled="" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Payment</button>
									</h4>
								</div>
								<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#checkout_wizard">
									<div class="checkout-step-body">
										<div class="payment_method-checkout">	
											<div class="row">	
												<div class="col-md-12">
													<div class="rpt100">													
														<ul class="radio--group-inline-container_1">
															<li>
																<div class="radio-item_1">
																	<input id="cashondelivery1" checked="" value="CashOnDelivery" name="paymentmethod" type="radio">
																	<label for="cashondelivery1" class="radio-label_1">Cash on Delivery</label>
																</div>
															</li>
															<li>
																<div class="radio-item_1">
																	<input id="card1" value="PaymentGateway" name="paymentmethod" type="radio">
																	<label  for="card1" class="radio-label_1">Pay Now</label>
																</div>
															</li>
															@if(session()->has('FRONT_USER_LOGIN'))
															<li id="removePrevBalDivList">
																<div class="radio-item_1" id="removePrevBalDiv">
																	<input id="wallet1" value="wallet" name="paymentmethod" type="radio">
																	<label  for="wallet1" onclick="paymentmethodWallet()" class="radio-label_1">Balance ₹{{$wallet_balance[0]->wallet}} </label>
																</div>
															</li>
															<input type="hidden" id="counertotalPrice" value="{{$totalPrice}}" name="counertotalPrice">
															<input type="hidden" id="finalwalletbalance" name="finalwalletbalance" value="{{$wallet_balance[0]->wallet}}" name="">
															@else
															<li>
																<div class="radio-item_1">
																	<input id="wallet" disabled="" value="wallet" name="paymentmethod" type="radio">
																	<label  for="wallet" class="radio-label_1">Pay From Wallet <span data-tooltip="Login to use this Payment Method" data-inverted="" data-position="top center"><i class="fas fa-info-circle"></i></span></label>
																</div>
															</li>
															@endif
														</ul>
													</div>
													<div class="form-group return-departure-dts" data-method="cashondelivery">															
														<div class="row">
															<div class="col-lg-12">
																<div class="pymnt_title">
																	<h4>Cash on Delivery</h4>
																	<p>Cash on Delivery will not be available if your order value exceeds $10.</p>
																</div>
															</div>														
														</div>
													</div>
													<div class="form-group return-departure-dts" data-method="card">															
														<div class="row">
															<div class="col-lg-12">
																<div class="pymnt_title mb-4">
																	<h4>Credit / Debit Card</h4>
																</div>
															</div>														
															<div class="col-lg-6">
																<div class="form-group mt-1">
																	<label class="control-label">Holder Name*</label>
																	<div class="ui search focus">
																		<div class="ui left icon input swdh11 swdh19">
																			<input class="prompt srch_explore" type="text" name="holdername" value="" id="holder[name]" required="" maxlength="64" placeholder="Holder Name">															
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group mt-1">
																	<label class="control-label">Card Number*</label>
																	<div class="ui search focus">
																		<div class="ui left icon input swdh11 swdh19">
																			<input class="prompt srch_explore" type="text" name="cardnumber" value="" id="card[number]" required="" maxlength="64" placeholder="Card Number">															
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group mt-1">																	
																	<label class="control-label">Expiration Month*</label>
																	<select class="ui fluid search dropdown form-dropdown" name="card[expire-month]">
																		<option value="">Month</option>
																		<option value="1">January</option>
																		<option value="2">February</option>
																		<option value="3">March</option>
																		<option value="4">April</option>
																		<option value="5">May</option>
																		<option value="6">June</option>
																		<option value="7">July</option>
																		<option value="8">August</option>
																		<option value="9">September</option>
																		<option value="10">October</option>
																		<option value="11">November</option>
																		<option value="12">December</option>
																	  </select>	
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group mt-1">
																	<label class="control-label">Expiration Year*</label>
																	<div class="ui search focus">
																		<div class="ui left icon input swdh11 swdh19">
																			<input class="prompt srch_explore" type="text" name="card[expire-year]" maxlength="4" placeholder="Year">															
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-4">
																<div class="form-group mt-1">
																	<label class="control-label">CVV*</label>
																	<div class="ui search focus">
																		<div class="ui left icon input swdh11 swdh19">
																			<input class="prompt srch_explore" name="card[cvc]" maxlength="3" placeholder="CVV">															
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<a class="next-btn16 text-light hover-btn" id="finalOrderBtn" onclick="paymentmethod()">Place Order</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<!-- Body End -->
	<form id="checkoutForm2">
		<input type="hidden" id="netSaving" value="{{$totalSaving}}" name="netSaving">
		<input type="hidden" id="buyer_add_type" value="home" name="buyer_add_type">
		<input type="hidden" id="buyer_number" value="{{$reg_customer_mobile}}" name="buyer_number">
		<input type="hidden" id="buyer_email" value="{{$reg_customer_email}}" name="buyer_email">
		<input type="hidden" id="buyer_name" name="buyer_name">
		<input type="hidden" id="buyer_add1" name="buyer_add1">
		<input type="hidden" id="buyer_add2" name="buyer_add2">
		<input type="hidden" id="buyer_city" name="buyer_city">
		<input type="hidden" id="buyer_state" name="buyer_state">
		<input type="hidden" id="buyer_zip" name="buyer_zip">
		<input type="hidden" id="delivery_date" value="<?php echo date("Y-m-d"); ?>" name="delivery_date">
		<input type="hidden" id="delivery_time" value="slot1" name="delivery_time">
		<input type="hidden" id="payment_method" name="payment_method">
		<input type="hidden" id="totalPrice" value="{{$totalPrice}}" name="totalPrice">
		<input type="hidden" id="discount" value="0" name="discount">
		<input type="hidden" id="coupon_id" value="0" name="coupon_id">
		<input type="hidden" id="couponcode" value="not available" name="coupon_code">
		<input type="hidden" id="coupon_value" value="0" name="coupon_value">
		<input type="hidden" id="counter1" value="0" name="counter1">
		@csrf
	</form>
@endsection
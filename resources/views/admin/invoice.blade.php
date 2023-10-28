<!DOCTYPE html>
<html lang="en">

	
<!-- Mirrored from gambolthemes.net/html-items/gambo_supermarket_demo/bill.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 26 May 2020 11:45:18 GMT -->
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">
		<meta name="description" content="Gambolthemes">
		<meta name="author" content="Gambolthemes">		
		<title>Gambo - Bill Invoice</title>

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
		
	</head>

<body>
	<!-- Header Start -->
	<header class="header clearfix">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="top-header-group">
						<div class="top-header">
							<div class="res_main_logo">
								<a href="index.html"><img src="{{asset('front_assets/images/dark-logo-1.svg')}}" alt=""></a>
							</div>
							<div class="main_logo ml-0" id="logo">
								<a href="index.html"><img src="{{asset('front_assets/images/logo.svg')}}" alt=""></a>
								<a href="index.html"><img class="logo-inverse" src="{{asset('front_assets/images/dark-logo.svg')}}" alt=""></a>
							</div>
							<div class="header_right">
								<a href="{{ url()->previous()}}" class="report-btn hover-btn">Back</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header End -->
	<!-- Body Start -->
	<div class="bill-dt-bg">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="bill-detail">
						<div class="bill-dt-step">
							<div class="bill-title">
								<h4>Items</h4>
							</div>
							<div class="bill-descp">
								@php $orderItems=count($orders_details); @endphp
								@if($orderItems==1)
								<div class="itm-ttl">{{$orderItems}} Item</div>
								@else
								<div class="itm-ttl">{{$orderItems}} Items</div>
								@endif
								@foreach($orders_details as $orders_details)
								<span class="item-prdct"><span class="text-capitalize">{{$orders_details->pname}}</span> {{$orders_details->qty}}*{{$orders_details->weight}}</span>
								@endforeach
							</div>
						</div>
						<div class="bill-dt-step">
							<div class="bill-title">
								<h4>Order Details</h4>
							</div>
							<div class="bill-descp">
								<p class="bill-dt-sl">Ordered On - <span class="descp-bll-dt">{{date('d M, Y', strtotime(($orders[0]->added_on)))}}</span></p>
								<p class="bill-dt-sl">Order Status - <span class="descp-bll-dt">{{ $orders[0]->order_status }} </span></p>
								<p class="bill-dt-sl text-capitalize">Payment Status - <span class="descp-bll-dt">{{ $orders[0]->payment_status }} </span></p>
							</div>
						</div>
						<div class="bill-dt-step">
							<div class="bill-title">
								<h4>Delivery Address</h4>
							</div>
							<div class="bill-descp">
								<div class="itm-ttl text-capitalize">{{$orders[0]->address_type}}</div>
								<p class="bill-address text-capitalize">{{$orders[0]->buyer_name}}, {{$orders[0]->address1}}, {{$orders[0]->address2}}, {{$orders[0]->city}}, {{$orders[0]->state}}, {{$orders[0]->pin_code}}</p>
								<div class="bill-address text-capitalize">Contact Number : {{$orders[0]->buyer_number}}</div>
							</div>
						</div>
						<div class="bill-dt-step">
							<div class="bill-title">
								<h4>Payment</h4>
							</div>
							<div class="bill-descp">
								<div class="total-checkout-group p-0 border-top-0">
									<div class="cart-total-dil">
										<h4>Subtotal</h4>
										<span>₹{{$orders[0]->total_price+$orders[0]->coupon_value}}</span>
									</div>
									@if($orders[0]->coupon_code!='not used')
									<div class="cart-total-dil pt-3">
										<h4>Coupon Discount</h4>
										<span>₹{{$orders[0]->discount}}</span>
									</div>
									@endif
									<div class="cart-total-dil pt-3">
										<h4>Delivery Charges</h4>
										<span>Free <del>₹{{$my_details[0]->delivery_charge}}</del></span>
									</div>
								</div>
								<div class="main-total-cart pl-0 pr-0 pb-0 border-bottom-0">
									<h2>Total</h2>
									<span>₹{{$orders[0]->total_price}}</span>
								</div>
							</div>
						</div>
						<div class="bill-dt-step">
							<div class="bill-title">
								<h4>Delivery Details</h4>
							</div>
							<div class="bill-descp">
								<p class="bill-dt-sl"><b>Super Store</b> - <span class="dly-loc">Ludhiana</span> - <span class="dlr-ttl25">$26</span></p>
								<p class="bill-dt-sl">Order ID - <span class="descp-bll-dt">{{$orders[0]->txnid}}</span></p>
								<p class="bill-dt-sl">Items - <span class="descp-bll-dt">{{$orderItems}}</span></p>
								@php
								$Delivery_timing='';
								if($orders[0]->delivery_time=='slot1'){
								$Delivery_timing='6AM to 8AM';
								}
								if($orders[0]->delivery_time=='slot2'){
								$Delivery_timing='8AM to 10AM';
								}
								if($orders[0]->delivery_time=='slot3'){
								$Delivery_timing='10A to -12PM';
								}
								if($orders[0]->delivery_time=='slot4'){
								$Delivery_timing='4PM to 6PM';
								}
								if($orders[0]->delivery_time=='slot5'){
								$Delivery_timing='6PM to 8PM';
								}
								$Delivery_date=date('d M, Y', strtotime(($orders[0]->delivery_date)));
								@endphp
								<p class="bill-dt-sl">Timing - <span class="descp-bll-dt">{{$Delivery_date}} between {{$Delivery_timing}}</span></p>
							</div>
						</div>
						<div class="bill-dt-step">
							<div class="bill-title">
								<h4>Payment Details</h4>
							</div>
							<div class="bill-descp">
								@php
								$pmethod='';
								if($orders[0]->payment_method == 'PaymentGateway'){
								$pmethod='Paid Online'; 
								}else{
								$pmethod='Cash On Delivery'; 
								}
								@endphp
								@if($orders[0]->payment_method == 'PaymentGateway')
								<p class="bill-dt-sl">Payment Method - {{ $pmethod }}</p>
								<p class="bill-dt-sl">Payment Id - {{$orders[0]->payment_id}}</p>
								@else
								<p class="bill-dt-sl"><span class="dlr-ttl25 mr-1"><i class="uil uil-check-circle"></i></span>{{ $pmethod }}</p>
								@endif
								<p class="bill-dt-sl">Transaction Id - {{$orders[0]->txnid}}</p>
							</div>
						</div>
						<div class="bill-dt-step">
							<div class="bill-bottom">
								<div class="thnk-ordr">Thanks for Ordering</div>
								<a class="print-btn hover-btn" href="javascript:window.print();">Print</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Body End -->
	
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

<!-- Mirrored from gambolthemes.net/html-items/gambo_supermarket_demo/bill.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 26 May 2020 11:45:18 GMT -->
</html>
@extends('front/layout')
@section('home_active','active')
@if($transaction_status=='Success')
	@section('page_title','Grockart - Order Placed Successfully')
@else
	@section('page_title','Grockart - Order Failed')
@endif
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
							<li class="breadcrumb-item active" aria-current="page">Order Placed</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="all-product-grid">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-8">
					<div class="order-placed-dt">
						@if($transaction_status=='Success')
						<i class="uil uil-check-circle icon-circle"></i>
						<h2>Order Placed Successfully</h2>
						<p>Thank you for shopping with us</p> 
							<!-- your order delivery timing - <span>({{$delivery_date, $delivery_time}})</span></p> -->
						<div class="delivery-address-bg">
							<div class="title585">
								<div class="pln-icon"><i class="uil uil-telegram-alt"></i></div>
								<h4>Order received - processing start.</h4>
							</div>
							@php
							$Delivery_timing='';
							if($delivery_time=='slot1'){
							$Delivery_timing='6AM-8AM';
							}
							if($delivery_time=='slot2'){
							$Delivery_timing='8AM-10AM';
							}
							if($delivery_time=='slot3'){
							$Delivery_timing='10AM-12PM';
							}
							if($delivery_time=='slot4'){
							$Delivery_timing='4PM-6PM';
							}
							if($delivery_time=='slot5'){
							$Delivery_timing='6PM-8PM';
							}
							$Delivery_date=date('d M, Y', strtotime(($delivery_date)));
							@endphp
							<ul class="address-placed-dt1">
								<!-- <li><p><i class="far fa-user"></i>User Name :<span>{{$name}}</span></p></li> -->
								<!-- <li><p><i class="fas fa-envelope"></i>Email Address :<span>{{$email}}</span></p></li> -->
								<li><p><i class="uil fas fa-box"></i>Order Id :<span>{{'OID'.rand(11111,99999).rand(11111,99999).'GK'.$orderId}}</span></p></li>
								<li><p><i class="fas fa-map-marker-alt"></i>Delivery Location :<span>{{$address1}}, {{$address2}}, {{$city}}, {{$state}}, {{$pin_code}}</span></p></li>
								<li><p><i class="far fa-clock"></i>Delivery on : <span>{{$Delivery_date}} between {{$Delivery_timing}}</span></p></li>
								<li><p><i class="far fa-thumbs-up"></i>Transaction Status :<span>{{$transaction_status}}</span></p></li>
								<li><p><i class="fas fa-money-bill-wave"></i>Transaction Id :<span>{{$txnid}}</span></p></li>
								@if($payment_method=='PaymentGateway')
								<li><p><i class="far fa-credit-card"></i>Payment Id :<span>{{$payment_id}}</span></p></li>
								<li><p><i class="fas fa-rupee-sign"></i>Payment Method :<span>Paid Online</span></p></li>
								<li><p><i class="far fa-hand-peace"></i>Payment Mode :<span>{{$payment_mode}}</span></p></li>
								@elseif($payment_method=='wallet')
								<li><p><i class="fas fa-rupee-sign"></i>Payment Method :<span>Paid From Wallet</span></p></li>
								@else
								<li><p><i class="fas fa-rupee-sign"></i>Payment Method :<span>Cash On Delivery</span></p></li>
								@endif
							</ul>
							<div class="stay-invoice">
								<div class="st-hm">Stay Home<i class="uil uil-smile"></i></div>
								<a href="{{url('user/order-detail/'.$orderId)}}" target="_blank" class="invc-link hover-btn">invoice</a>
							</div>

							<div class="placed-bottom-dt">
								@if($payment_method=='PaymentGateway')
								We received the payment of <span>₹{{$orderAmount}}</span> and start processing your order.
								@elseif($payment_method=='wallet')
								We received the payment of <span>₹{{$orderAmount}}</span> and start processing your order.
								@else
								The payment of <span>₹{{$orderAmount}}</span> you'll make when the delivery arrives with your order.
								@endif
							</div>
						</div>
						@endif
						@if($transaction_status=='Failed')
						<i class="far fa-times-circle icon-circle"></i>
						<h2>Order Failed!</h2>
						<p class="text-capitalize">something went wrong...</p>
						<div class="delivery-address-bg">
							<div class="title585">
								<div class="pln-icon"><i class="uil uil-telegram-alt"></i></div>
								<h4>Your order is cancelled.</h4>
							</div>
							<ul class="address-placed-dt1">
								<li><p><i class="far fa-user"></i>User Name :<span>{{$name}}</span></p></li>
								<li><p><i class="fas fa-envelope"></i>Email Address :<span>{{$email}}</span></p></li>
								<li><p><i class="uil fas fa-box"></i>Order Id :<span>{{'OID'.rand(11111,99999).rand(11111,99999).'GK'.$orderId}}</span></p></li>
								<li><p><i class="far fa-thumbs-down"></i>Transaction Status :<span>{{$transaction_status}}</span></p></li>
								@if($payment_method=='PaymentGateway')
								<li><p><i class="fas fa-money-bill-wave"></i>Transaction Id :<span>{{$txnid}}</span></p></li>
								<li><p><i class="far fa-credit-card"></i>Payment Id :<span>{{$payment_id}}</span></p></li>
								<li><p><i class="fas fa-rupee-sign"></i>Payment Method :<span>Paid Online</span></p></li>
								<li><p><i class="far fa-hand-peace"></i>Payment Mode :<span>{{$payment_mode}}</span></p></li>
								@elseif($payment_method=='wallet')
								<li><p><i class="fas fa-rupee-sign"></i>Payment Method :<span>Paid From Wallet</span></p></li>
								@else
								<li><p><i class="fas fa-rupee-sign"></i>Payment Method :<span>Cash On Delivery</span></p></li>
								@endif
							</ul>
							<div class="stay-invoice">
								<div class="st-hm">Stay Home<i class="uil uil-smile"></i></div>
								<a href="{{url('user/order-detail/'.$orderId)}}" target="_blank" class="invc-link hover-btn">invoice</a>
							</div>
							<div class="placed-bottom-dt">
								@if($payment_method=='PaymentGateway')
								The payment of <span>₹{{$orderAmount}}</span> will be refunded at the original source, <span class="d-md-block" style="color: #2b2f4c;font-weight: 400">if the money is deducted.</span>
								@elseif($payment_method=='wallet')
								The payment of <span>₹{{$orderAmount}}</span> will be refunded in wallet, <span class="d-md-block" style="color: #2b2f4c;font-weight: 400">if the money is deducted.</span>
								@else
								You dont need to make the payment of <span>₹{{$orderAmount}}</span> for your order at the time of delivery.
								@endif
							</div>
						</div>
						@endif
					</div>
				<Fdived>
			</div>
		</div>
	</div>	
</div>
<!-- Body End -->
@endsection
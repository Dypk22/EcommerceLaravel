@extends('front/dashboardTemplate')
@section('orders_active','active')
@section('page_title','Grockart | Checkout Now')
@section('Dashboardcontainer')
	<!-- Body Start -->
	<div class="col-lg-9 col-md-8">
		<div class="dashboard-right">
			<div class="row">
				<div class="col-md-12">
					<div class="main-title-tab">
						<h4><i class="uil uil-box"></i>My Orders</h4>
					</div>
				</div>
				<div class="col-lg-12 col-md-12">
					@foreach($orders as $orders)
					<div class="pdpt-bg">
						<div class="pdpt-title">
							@php
							$Delivery_timing='';
							if($orders->delivery_time=='slot1'){
							$Delivery_timing='6AM to 8AM';
							}
							if($orders->delivery_time=='slot2'){
							$Delivery_timing='8AM to 10AM';
							}
							if($orders->delivery_time=='slot3'){
							$Delivery_timing='10A to -12PM';
							}
							if($orders->delivery_time=='slot4'){
							$Delivery_timing='4PM to 6PM';
							}
							if($orders->delivery_time=='slot5'){
							$Delivery_timing='6PM to 8PM';
							}
							$Delivery_date=date('d M, Y', strtotime(($orders->delivery_date)));
							@endphp
							<h6>Delivery Timing {{$Delivery_date}} - Between {{$Delivery_timing}}</h6>
						</div> 
						<div class="order-body10">
							<ul class="order-dtsll">
								<li>
									<div class="order-dt-img">
										<img src="{{asset('front_assets/images/groceries.svg')}}" alt="">
									</div>
								</li>
								<li>
									<div class="order-dt47">
										<h4>Grockart - Haridwar</h4>
										<p>By Grockart Grocceries Delivery Service</p>
										<div class="order-title">Status - {{$orders->order_status}}</div>
									</div>
								</li>
							</ul>
							<div class="total-dt">
								<div class="total-checkout-group">
									@if($orders->coupon_value !=0)
									<div class="cart-total-dil">
										<h4>Sub Total</h4>
										<span>₹{{$orders->discount+$orders->total_price}}</span>
									</div>
									<div class="cart-total-dil pt-3">
										<h4>Coupon Value</h4>
										<span>₹{{$orders->discount}}</span>
									</div>
									@else
									<div class="cart-total-dil pt-3">
										<h4>Sub Total</h4>
										<span>$25</span>
									</div>
									@endif
									<div class="cart-total-dil pt-3">
										<h4>Delivery Charges</h4>
										<span>Free <del>₹{{$my_details[0]->delivery_charge}}</del></span>
									</div>
								</div>
								<div class="main-total-cart">
									<h2>Total</h2>
									<span>₹{{$orders->total_price}}</span>
								</div>
							</div>
							<div class="track-order">
								<h4>Track Order</h4>
								@if($orders->order_status=='Received')
								<div class="bs-wizard" style="border-bottom:0;">   
									<div class="bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">Received</div>
										<div class="progress"></div>
										<a class="bs-wizard-dot"></a>
									</div>
									<div class="bs-wizard-step">
										<div class="text-center bs-wizard-stepnum">Processing</div>
										<div class="progress"></div>
										<a class="bs-wizard-dot" style="background: none"></a>
									</div>
									<div class="bs-wizard-step">
										<div class="text-center bs-wizard-stepnum">On the way</div>
										<div class="progress"></div>
										<a class="bs-wizard-dot" style="background: none"></a>
									</div>
									<div class="bs-wizard-step">
										<div class="text-center bs-wizard-stepnum">Delivered</div>
										<div class="progress"></div>
										<a class="bs-wizard-dot" style="background: none"></a>
									</div>
								</div>
								@elseif($orders->order_status=='Processing')
								<div class="bs-wizard" style="border-bottom:0;">   
									<div class="bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">Received</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a class="bs-wizard-dot"></a>
									</div>
									<div class="bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">Processing</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a class="bs-wizard-dot"></a>
									</div>
									<div class="bs-wizard-step">
										<div class="text-center bs-wizard-stepnum">On the way</div>
										<div class="progress"></div>
										<a class="bs-wizard-dot" style="background: none"></a>
									</div>
									<div class="bs-wizard-step">
										<div class="text-center bs-wizard-stepnum">Delivered</div>
										<div class="progress"></div>
										<a class="bs-wizard-dot" style="background: none"></a>
									</div>
								</div>
								@elseif($orders->order_status=='Out For Delivery')
								<div class="bs-wizard" style="border-bottom:0;">   
									<div class="bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">Placed</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot"></a>
									</div>
									<div class="bs-wizard-step complete"><!-- complete -->
										<div class="text-center bs-wizard-stepnum">Packed</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot"></a>
									</div>
									<div class="bs-wizard-step active"><!-- complete -->
										<div class="text-center bs-wizard-stepnum">On the way</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot"></a>
									</div>
									<div class="bs-wizard-step">
										<div class="text-center bs-wizard-stepnum">Delivered</div>
										<div class="progress"></div>
										<a class="bs-wizard-dot" style="background: none"></a>
									</div>
								</div>
								@elseif($orders->order_status=='Complete')
								<div class="bs-wizard" style="border-bottom:0;">   
									<div class="bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">Received</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a class="bs-wizard-dot"></a>
									</div>
									<div class="bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">Packed</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a class="bs-wizard-dot complete"></a>
									</div>
									<div class="bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">On the way</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a class="bs-wizard-dot complete"></a>
									</div>
									<div class="bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">Delivered</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a class="bs-wizard-dot complete"></a>
									</div>
								</div>
								@else
								<div class="bs-wizard" style="border-bottom:0;">   
									<div class="bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">Received</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a class="bs-wizard-dot"></a>
									</div>
									<div class="bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">Packed</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a class="bs-wizard-dot complete"></a>
									</div>
									<div class="bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">Canceled</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a class="bs-wizard-dot"></a>
									</div>
								</div>
								@endif
							</div>
							<div class="call-bill">
								@if($orders->order_status=='Canceled')
								
								@elseif($orders->order_status!='Canceled' && $orders->order_status=='Complete')
								<div class="delivery-man">
									<a href="{{url('/user/order-review/'.$orders->id)}}"><i class="uil uil-rss"></i>Feedback</a>
								</div>
								<div class="order-bill-slip">
									<a href="{{url('user/order-detail/'.$orders->id)}}" class="bill-btn5 hover-btn">View Bill</a>
								</div>
								@else
								<div class="delivery-man">
									<a href="tel:{{$my_details[0]->mobile}}"><i class="uil uil-phone-alt"></i>Call Delivery Man</a>
								</div>
								<div class="order-bill-slip">
									<a href="{{url('user/order-detail/'.$orders->id)}}" target="_blank" class="bill-btn5 hover-btn">View Bill</a>
								</div>
								@endif
							</div>
						</div>
					</div>
					@endforeach
				</div>								
			</div>
		</div>
	</div>
	<!-- Body End -->	
@endsection
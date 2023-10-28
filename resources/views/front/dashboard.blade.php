@extends('front/dashboardTemplate')
@section('dashboard_active','active')
@section('page_title','Grockart | Checkout Now')
@section('Dashboardcontainer')
	<!-- Body Start -->
	<div class="col-lg-9 col-md-8">
		<div class="dashboard-right">
			<div class="row">
				<div class="col-md-12">
					<div class="main-title-tab">
						<h4><i class="uil uil-apps"></i>Overview</h4>
					</div>
					<div class="welcome-text">
						<h2 class="text-capitalize">hi! {{$customer_info[0]->name}}</h2>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="pdpt-bg">
						<div class="pdpt-title">
							<h4>My Rewards</h4>
						</div>
						<div class="ddsh-body">
							<h2>No Rewards</h2>
							<!-- <ul>
								<li>
									<a href="#" class="small-reward-dt hover-btn">Won $2</a>
								</li>
								<li>
									<a href="#" class="small-reward-dt hover-btn">Won 40% Off</a>
								</li>
								<li>
									<a href="#" class="small-reward-dt hover-btn">Caskback $1</a>
								</li>
								<li>
									<a href="#" class="rewards-link5">+More</a>
								</li>
							</ul> -->
						</div>
						<a href="{{url('user/rewards')}}" class="more-link14">Rewards and Details <i class="uil uil-angle-double-right"></i></a>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="pdpt-bg">
						<div class="pdpt-title">
							<h4>My Orders</h4>
						</div>
						<div class="ddsh-body">
							<h2>Recently Purchases</h2>
							<ul class="order-list-145">
								@foreach($my_orders as $my_orders)
								<li>
									<div class="smll-history">
										<div class="order-title">{{date('d M, Y', strtotime($my_orders->added_on))}}</div>
										<div class="order-status">{{$my_orders->name}}</div>
										<p>₹{{$my_orders->total_price}}</p>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
						<a href="{{url('/user/orders')}}" class="more-link14">All Orders <i class="uil uil-angle-double-right"></i></a>
					</div>
				</div>
				<div class="col-lg-12 col-md-12">
					<div class="pdpt-bg">
						<div class="pdpt-title">
							<h4>My Wallet</h4>
						</div>
						<div class="wllt-body">
							<h2>Balance ₹{{$customer_info[0]->wallet}}</h2>
							<ul class="wallet-list">
								<li>
									<a href="{{url('user/wishlist')}}" class="wallet-links14"><i class="uil uil-card-atm"></i>My Wishlist</a>
								</li>
								<li>
									<a href="{{url('user/rewards')}}" class="wallet-links14"><i class="uil uil-gift"></i>No offers Active</a>
								</li>	
								<li>
									<a href="{{url('offers')}}" class="wallet-links14"><i class="uil uil-coins"></i>Offers</a>
								</li>	
							</ul>
						</div>
						<a href="{{url('user/wallet')}}" class="more-link14">Wallet Details <i class="uil uil-angle-double-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Body End -->

@endsection
@extends('front/dashboardTemplate')
@section('rewards_active','active')
@section('page_title','Grockart | Checkout Now')
@section('Dashboardcontainer')
	<!-- Body Start -->
<div class="col-lg-9 col-md-8">
	<div class="dashboard-right">
		<div class="row">
			<div class="col-md-12">
				<div class="main-title-tab">
					<h4><i class="uil uil-gift"></i>My Rewards</h4>
				</div>
			</div>
			<!-- <div class="col-lg-12 col-md-12">
				<div class="pdpt-bg">
					<ul class="reward-body-all">
						<li>
							<div class="total-rewards">
								<div class="tt-icon"><i class="uil uil-money-withdraw"></i></div>
								<span>Cashbacks</span>
								<h4>$15</h4>
							</div>
						</li>
						<li>
							<div class="total-rewards">
								<div class="tt-icon"><i class="uil uil-percentage"></i></div>
								<span>Offers</span>
								<h4>$5</h4>
							</div>
						</li>
						<li>
							<div class="total-rewards">
								<div class="tt-icon"><i class="uil uil-tag-alt"></i></div>
								<span>Coupons</span>
								<h4>2</h4>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-md-12">
				<div class="pdpt-bg">
					<div class="reward-body-dtt">
						<div class="reward-img-icon">
							<img src="images/gift.svg" alt="">
						</div>
						<span class="rewrd-title">Cashback Won</span>
						<h4 class="cashbk-price">$2</h4>
						<span class="date-reward">12 May 2020</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12">
				<div class="pdpt-bg rewards-coupns">
					<div class="reward-body-dtt">
						<div class="reward-img-icon">
							<img src="images/discount.svg" alt="">
						</div>
						<span class="rewrd-title">Offer</span>
						<h4 class="cashbk-price">Get 25% Cashback</h4>
						<span class="date-reward">Expires on : 31st May</span>
					</div>
					<div class="top-coup-code" title="Coupon Code">Gambocoup25</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12">
				<div class="pdpt-bg rewards-coupns">
					<div class="reward-body-dtt">
						<div class="reward-img-icon">
							<img src="images/coupon.svg" alt="">
						</div>
						<span class="rewrd-title">Coupon Won</span>
						<h4 class="cashbk-price">Get 10% Cashback</h4>
						<span class="date-reward">Expires on : 25th May</span>
					</div>
					<div class="top-coup-code" title="Coupon Code">Gambocoup10</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12">
				<div class="pdpt-bg rewards-coupns">
					<div class="reward-body-dtt">
						<div class="reward-img-icon">
							<img src="images/discount.svg" alt="">
						</div>
						<span class="rewrd-title">Offer</span>
						<h4 class="cashbk-price">Get 15% Cashback</h4>
						<span class="date-reward">Expired on : 5th May</span>						
					</div>
					<div class="top-coup-code" title="Coupon Code">Gambocoup15</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12">
				<div class="pdpt-bg rewards-coupns">
					<div class="reward-body-dtt">
						<div class="reward-img-icon">
							<img src="images/coupon.svg" alt="">
						</div>
						<span class="rewrd-title">Coupon Won</span>
						<h4 class="cashbk-price">Get 5% Cashback</h4>
						<span class="date-reward">Expires on : 20th May</span>
					</div>
					<div class="top-coup-code" title="Coupon Code">Gambocoup5</div>
				</div>
			</div> -->
			<div class="col-lg-4 col-md-12">
				<div class="pdpt-bg">
					<div class="reward-body-dtt">
						<div class="reward-img-icon">
							<img src="{{asset('front_assets/images/gift.svg')}}" alt="">
						</div>
						<span class="rewrd-title">No Rewards Yet</span>
						<!-- <h4 class="cashbk-price">$1</h4> -->
						<!-- <span class="date-reward">3 May 2020</span> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- Body End -->	
@endsection
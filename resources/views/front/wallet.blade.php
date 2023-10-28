@extends('front/dashboardTemplate')
@section('wallet_active','active')
@section('page_title','Grockart | My Wallet')
@section('Dashboardcontainer')
	<!-- Body Start -->
<div class="col-lg-9 col-md-8">
	<div class="dashboard-right">
		<div class="row">
			<div class="col-md-12">
				<div class="main-title-tab">
					<h4><i class="uil uil-wallet"></i>My Wallet</h4>
				</div>
			</div>								
			<div class="col-lg-6 col-md-12">
				<div class="pdpt-bg">
					<div class="reward-body-dtt">
						<div class="reward-img-icon">
							<img src="{{asset('front_assets/images/money.svg')}}" alt="">
						</div>
						<span class="rewrd-title">My Balance</span>
						<h4 class="cashbk-price">₹{{$my_wallet->updated_balance}}</h4>
						<span class="date-reward">Updated : {{$my_wallet->added_on}}</span>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="pdpt-bg">
					<div class="gambo-body-cash">
						<div class="reward-img-icon">
							<img class="rotate-img" src="{{asset('front_assets/images/business.svg')}}" alt="">
						</div>
						<span class="rewrd-title">Grockart Cashback Blance</span>
						<h4 class="cashbk-price">₹{{$my_wallet->updated_cashback}}</h4>
						<p>100% of this can be used for your next order.</p>
					</div>
				</div>
			</div>
			<!-- <div class="col-lg-12 col-md-12">
				<div class="pdpt-bg">
					<div class="pdpt-title">
						<h4>Active Offers</h4>
					</div>
					<div class="active-offers-body">
						<div class="table-responsive">
							<table class="table ucp-table earning__table">
								<thead class="thead-s">
									<tr>
										<th scope="col">Offers</th>
										<th scope="col">Offer Code</th>
										<th scope="col">Expires Date</th>
										<th scope="col">Status</th>								
									</tr>
								</thead>
								<tbody>
									<tr>										
										<td>15%</td>	
										<td>GAMBOCOUP15</td>	
										<td>31 May 2020</td>	
										<td><b class="offer_active">Activated</b></td>	
									</tr>
									<tr>										
										<td>10%</td>	
										<td>GAMBOCOUP10</td>	
										<td>25 May 2020</td>	
										<td><b class="offer_active">Activated</b></td>	
									</tr>
									<tr>										
										<td>25%</td>	
										<td>GAMBOCOUP25</td>	
										<td>20 May 2020</td>	
										<td><b class="offer_active">Activated</b></td>	
									</tr>
									<tr>										
										<td>5%</td>	
										<td>GAMBOCOUP05</td>	
										<td>15 May 2020</td>	
										<td><b class="offer_active">Activated</b></td>	
									</tr>
								</tbody>				
							</table>
						</div>	
					</div>
				</div>
			</div> -->
			<div class="col-lg-6 col-md-12">
				<div class="pdpt-bg">
					<div class="pdpt-title">
						<h4>Add Balance</h4>
					</div>
					<div class="add-cash-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group mt-1 mb-0">
									<label class="control-label">Amount to Add*</label>
									<div class="ui search focus">
										<div class="ui left icon row input swdh11 swdh19">
											<input class="prompt srch_explore" id="add_money" onchange="amt(value)" type="number" name="addbalance" maxlength="4" placeholder="Enter Amount">															
										</div>
									</div>
									<a data-toggle="collapse" data-target="#promocode" class="promo-link45 m-0 mt-2 py-1 collapsed text-left pl-0" style="box-shadow: none;">Apply promocode</a>
								</div>
								<div class="form-group m-0 my-2 from-mobile col-md-10 pl-0">
									<div class="collapse" id="promocode">
									  <div class="promo-link45 mt-0 mb-3" style="padding: 0 !important;">
									  	<!-- <form action="#" method="post"> -->
											<div class="input-group mb-2">
											  <input type="text" class="form-control custom_input" style="font-weight: 400 !important;" id="coupon_code" name="coupon_code" placeholder="Enter Coupon">
											  <button class="chck-btn hover-btn" type="button" id="submitCouponBtn" style="border: none;" onclick="applyAddMoneyCouponCode()">Apply</button>
											  <button class="chck-btn hover-btn" type="button" id="removeCouponBtn" style="border: none; display: none;" onclick="removeAddMoneyCouponCode()">Remove</button>
											</div>
										<!-- </form>						     -->
									  </div>
									</div>						
								</div>
							</div>
						</div>
						<a class="next-btn16 text-light hover-btn" onclick="add_money()">Add Balance</a>
						<div class="alert custom_alert mt-3" role="alert" id="addcoupon_result"></div>	  
					</div>
				</div>
				<form id="frmAddMoney">
				  	<input type="hidden" value="0" id="addMoneyAmt" name="addMoneyAmt">
				  	<input type="hidden" value="" id="addMoneyCoupon" name="addMoneyCoupon">
				  	<input type="hidden" value="0" id="finalAddAmt" name="finalAddAmt">
				 </form>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="pdpt-bg">
					<div class="pdpt-title">
						<h4>History</h4>
					</div>
					<div class="history-body scrollstyle_4">
						<ul class="history-list">
							@foreach($wallet_info as $wallet_info)
							<li>
								<div class="purchase-history">
									<div class="purchase-history-left">
									    @if($wallet_info->type=='referal-cashback-received')
									    <h4>Referal Cashback Credited</h4>
										@elseif($wallet_info->type=='paid-from-wallet')
										<h4>Paid To Order</h4>
										@elseif($wallet_info->type=='cashback-received')
										<h4>Cashback Credited</h4>
										@elseif($wallet_info->type=='money-add-fail')
										<h4>Add Money Transaction Fail</h4>
										@elseif($wallet_info->type=='money-add-success')
										<h4>Money Added To Wallet</h4>										
										@else
										<h4>Money Added To Wallet Failed</h4>										
										@endif
										<p>Transaction ID <ins>{{$wallet_info->payment_id}}</ins></p>
										<span>{{date('d M, Y', strtotime($wallet_info->added_on))}}</span>
									</div>
									<div class="purchase-history-right">
									    @if($wallet_info->type=='referal-cashback-received')
										<span>+₹{{$wallet_info->cashback}}</span>
										@elseif($wallet_info->type=='cashback-received')
										<span>+₹{{$wallet_info->cashback}}</span>
										@elseif($wallet_info->type=='paid-from-wallet')
										<span>-₹{{$wallet_info->amount}}</span>
										@elseif($wallet_info->type=='money-add-success')
										<span>+₹{{$wallet_info->amount}}</span>
										@else
										<span>₹{{$wallet_info->amount}}</span>
										@endif
										<!-- <a href="#">View</a> -->
									</div>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- Body End -->	
@endsection
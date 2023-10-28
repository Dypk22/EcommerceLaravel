@extends('front/dashboardTemplate')
@section('address_active','active')
@section('page_title','Grockart | My Addresses')
@section('Dashboardcontainer')
	<!-- Body Start -->
<div class="col-lg-9 col-md-8">
	<div class="dashboard-right">
		<div class="row">
			<div class="col-md-12">
				<div class="main-title-tab">
					<h4><i class="uil uil-location-point"></i>My Address</h4>
				</div>
			</div>
			<div class="col-lg-12 col-md-12">
				<div class="pdpt-bg">
					@if($addAddress=='add')
					<div class="pdpt-title">
						<h4>Add Address</h4>
					</div>
					<div class="add-address-form">
						<div class="checout-address-step">
							<div class="row">
								<div class="col-lg-12">												
									<form class="" method="post">
										<!-- Multiple Radios (inline) -->
										<div class="form-group">
											<div class="product-radio">
												<ul class="product-now">
													<li>
														<input type="radio" id="ad1" checked="" name="address1">
														<label for="ad1" class="ad1" onclick="setaddType('home')">Home</label>
													</li>
													<li>
														<input type="radio" id="ad2" name="address1">
														<label for="ad2" class="ad2" onclick="setaddType('office')">Office</label>
													</li>
													<li>
														<input type="radio" id="ad3" name="address1">
														<label for="ad3" class="ad3" onclick="setaddType('other')">Other</label>
													</li>
												</ul>
											</div>
										</div>
										<input type="hidden" id="setaddType" name="user_addresses_type">
										<div class="address-fieldset">
											<div class="row">
												<div class="col-lg-12 col-md-12">
													<div class="form-group">
														<label class="control-label">Name*</label>
														<input id="add_addresses_name" type="text" placeholder="Name" class="form-control input-md">
													</div>
												</div>
												<div class="col-lg-12 col-md-12">
													<div class="form-group">
														<label class="control-label">Flat / House / Office No.*</label>
														<input id="add_addresses_main_address" type="text" placeholder="Flat / House / Office No." class="form-control input-md">
													</div>
												</div>
												<div class="col-lg-12 col-md-12">
													<div class="form-group">
														<label class="control-label">Street / Society*</label>
														<input id="add_addresses_street" type="text" placeholder="Street / Society" class="form-control input-md">
													</div>
												</div>
												<div class="col-lg-4 col-md-12">
													<div class="form-group">
														<label class="control-label">City*</label>
														<input type="text" id="add_addresses_city" placeholder="City" class="form-control input-md">
													</div>
												</div>
												<div class="col-lg-4 col-md-12">
													<div class="form-group">
														<label class="control-label">State*</label>
														<input id="add_addresses_state" type="text" placeholder="State" class="form-control input-md">
													</div>
												</div>
												<div class="col-lg-4 col-md-12">
													<div class="form-group">
														<label class="control-label">Pincode*</label>
														<input id="add_addresses_pincode" type="number" placeholder="Pincode" class="form-control input-md">
													</div>
												</div>
												<div class="col-lg-12 col-md-12">
													<div class="form-group mb-0">
														<div class="address-btns">
															<button class="save-btn14 hover-btn" type="button" onclick="btnAddress()">Save</button>
														</div>
													</div>
												</div>
											</div>
										</div>
										@csrf
									</form>
								</div>
							</div>
						</div>
					</div>
					@elseif($CheckAddress==1)
					<div class="pdpt-title">
						<h4>Update Address</h4>
					</div>
					<div class="address-body">
						<div class="address-item pt-0">
							<div class="add-address-form">
								<div class="checout-address-step">
									<div class="row">
										<div class="col-lg-12">												
											<form class="" method="post" action="{{url('/user/address/'.$updateAddress[0]->id)}}">
												<!-- Multiple Radios (inline) -->
												<div class="form-group">
													<div class="product-radio">
														<ul class="product-now">
															@if($updateAddress[0]->address_type=='home')
															<li>
																<input type="radio" id="ad1" checked>
																<label for="ad1" onclick="setAddressType('home')">Home</label>
															</li>
															<li>
																<input type="radio" id="ad2">
																<label for="ad2" style="background: #c7c7c7;" onclick="setAddressType('office')">Office</label>
															</li>
															<li>
																<input type="radio" id="ad3">
																<label for="ad3" style="background: #c7c7c7;" onclick="setAddressType('other')">Other</label>
															</li>
															@elseif($updateAddress[0]->address_type=='office')
															<li>
																<input type="radio" id="ad4">
																<label for="ad4" style="background: #c7c7c7;" onclick="setAddressType('home')">Home</label>
															</li>
															<li>
																<input type="radio" id="ad6" checked="">
																<label for="ad6" onclick="setAddressType('office')">Office</label>
															</li>
															<li>
																<input type="radio" id="ad7">
																<label for="ad7" style="background: #c7c7c7;" onclick="setAddressType('other')">Other</label>
															</li>
															@else
															<li>
																<input type="radio" id="ad5">
																<label for="ad5" style="background: #c7c7c7;" onclick="setAddressType('home')">Home</label>
															</li>
															<li>
																<input type="radio" id="ad9">
																<label for="ad9" style="background: #c7c7c7;" onclick="setAddressType('office')">Office</label>
															</li>
															<li>
																<input type="radio" id="ad8" checked="">
																<label for="ad8" onclick="setAddressType('other')">Other</label>
															</li>
															@endif
														</ul>
													</div>
												</div>
												<input type="hidden" id="addType" name="user_addresses_type" value="{{$updateAddress[0]->address_type}}">
												<div class="address-fieldset">
													<div class="row">
														<div class="col-lg-12 col-md-12">
															<div class="form-group">
																<label class="control-label">Flat / House / Appartment Name*</label>
																<input name="user_addresses_name" type="text" value="{{$updateAddress[0]->user_addresses_name}}" placeholder="Address" class="form-control input-md" required="">
															</div>
														</div>
														<div class="col-lg-12 col-md-12">
															<div class="form-group">
																<label class="control-label">Flat / House / Office No.*</label>
																<input name="main_address" type="text" value="{{$updateAddress[0]->main_address}}" placeholder="Address" class="form-control input-md" required="">
															</div>
														</div>
														<div class="col-lg-12 col-md-12">
															<div class="form-group">
																<label class="control-label">Street / Society / Office Name*</label>
																<input name="street" type="text" value="{{$updateAddress[0]->street}}" placeholder="Street Address" class="form-control input-md">
															</div>
														</div>
														<div class="col-lg-4 col-md-12">
															<div class="form-group">
																<label class="control-label">Locality*</label>
																<input name="city" type="text" value="{{$updateAddress[0]->city}}" placeholder="Enter City" class="form-control input-md" required="">
															</div>
														</div>
														<div class="col-lg-4 col-md-12">
															<div class="form-group">
																<label class="control-label">State*</label>
																<input name="state" type="text" value="{{$updateAddress[0]->state}}" placeholder="Enter State" class="form-control input-md" required="">
															</div>
														</div>
														<div class="col-lg-4 col-md-12">
															<div class="form-group">
																<label class="control-label">Pincode*</label>
																<input name="pincode" type="text" value="{{$updateAddress[0]->pincode}}" placeholder="Pincode" class="form-control input-md" required="">
															</div>
														</div>
														<div class="col-lg-12 col-md-12">
															<div class="form-group mb-0">
																<div class="address-btns">
																	<a href="{{url('/user/address')}}" style="line-height: 2.7;" class="save-btn14 hover-btn">Back</a>
																	<button type="submit" class="ml-auto save-btn14 hover-btn">Update</button>
																</div>
															</div>
														</div>
													</div>
												</div>
												@csrf
											</form>
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>					
					@else
					<div class="pdpt-title">
						<h4>My Address</h4>
					</div>
					<div class="address-body">
						<a href="{{url('user/address/add')}}" class="add-address hover-btn">Add New Address</a>
						@if(isset($addresses[0]))
						@foreach($addresses as $addresses)
						<div class="address-item">
							<div class="address-icon1">
								<i class="uil uil-home-alt"></i>
							</div>
							<div class="address-dt-all">
								<h4 class="text-capitalize">{{$addresses->address_type}}</h4>
								<p class="text-capitalize">{{$addresses->user_addresses_name}}, {{$addresses->main_address}}, {{$addresses->street}}, {{$addresses->city}}, {{$addresses->state}}, {{$addresses->pincode}}</p>
								<ul class="action-btns">
									<li><a href="{{url('user/address/update/'.$addresses->id)}}" class="action-btn"><i class="uil uil-edit"></i></a></li>
									<li><a href="{{url('/user/address/delete/'.$addresses->id)}}" class="action-btn"><i class="uil uil-trash-alt"></i></a></li>
								</ul>
							</div>							
						</div>
						@endforeach
						@else
						<div class="address-item">
							<div class="address-dt-all">
								<h4 class="text-capitalize">You don't had added any addresses!</h4>
							</div>
						</div>
						@endif
					</div>
					@endif		
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- Body End -->	
@endsection
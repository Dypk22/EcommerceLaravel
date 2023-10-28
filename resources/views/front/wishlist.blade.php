@extends('front/dashboardTemplate')
@section('wishlist_active','active')
@section('page_title','Grockart | Checkout Now')
@section('Dashboardcontainer')
	<!-- Body Start -->
<div class="col-lg-9 col-md-8">
	<div class="dashboard-right">
		<div class="row">
			<div class="col-md-12">
				<div class="main-title-tab">
					<h4><i class="uil uil-heart"></i>Shopping Wishlist</h4>
				</div>
			</div>								
			<div class="col-lg-12 col-md-12">
				@if(isset($wishlistDetails))
				<div class="pdpt-bg">
					<div class="wishlist-body-dtt">
						@foreach($wishlistDetails as $wishlistDetails)
						<div class="cart-item">
							<div class="cart-product-img">
								<img src="{{asset('storage/ProductsImage/')}}/{{$wishlistDetails[0]->image1}}" alt="">
								<div class="offer-badge">{{$wishlistDetails[0]->discount}}% OFF</div>
							</div>
							<div class="cart-text">
								<h4>{{$wishlistDetails[0]->name}}</h4>
								<div class="cart-item-price">₹{{$wishlistDetails[0]->price}} <span>₹{{$wishlistDetails[0]->mrp}}</span></div>
								<button type="button" class="cart-close-btn"><a href="{{url('/user/wishlist/delete/'.$wishlistDetails[0]->wid)}}"><i class="uil uil-trash-alt"></i></a></button>
							</div>		
						</div>
						@endforeach
					</div>
				</div>
				@else
				<h5 style="font-weight: 400;margin: 30px 20px;">Wishlist Empty!</h5>
				@endif
			</div>
		</div>
	</div>
</div>
	<!-- Body End -->	
@endsection
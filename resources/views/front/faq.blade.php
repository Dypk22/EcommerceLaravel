@extends('front/layout')
@section('home_active','')
@section('page_title','Buy ')
@section('container')
<!-- Body Start -->
	<div class="wrapper">
		<div class="gambo-Breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Offers</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="all-product-grid">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="default-title mt-4">
							<h2>Frequently Asked Questions</h2>
							<img src="images/line.svg" alt="">
						</div>
						<div class="panel-group accordion pt-1" id="accordion0">
							<div class="panel panel-default">
								<div class="panel-heading" id="headingOne">
									<div class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-target="#collapseOne" href="#" aria-expanded="false" aria-controls="collapseOne">
											What kind of products do we sell?
										</a>
									</div>
								</div>
								<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion0" style="">
									<div class="panel-body">
										<p>You can choose from over 120,000 products spread across various categories such as grocery, fruits & vegetables, beverages, personal care products, baby care products, pet products and much more.</p>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading" id="headingTwo">
									<div class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" href="#" aria-expanded="false" aria-controls="collapseTwo">
											What cities and locations do we operate in?
										</a>
									</div>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion0">
									<div class="panel-body">
										<p>Currently we're operates in Haridwar only. Our target is to reach 20+ cities in India next couples of months.</p>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading" id="headingThree">
									 <div class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-target="#collapseThree" href="#" aria-expanded="false" aria-controls="collapseThree">
											What is the minimum order value?
										</a>
									</div>
								</div>
								<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion0">
									<div class="panel-body">
										<p>There is no minimum order value. In case your order does not reach the ₹200, a delivery charge of <del>₹29</del> will be levied against that order.<br> Now get free delivery delivery across on all order.</p>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading" id="headingfour">
									<div class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-target="#collapsefour" href="#" aria-expanded="false" aria-controls="collapsefour">
											Order Related - How can I be sure the fruits and vegetables I order are of good quality?
										</a>
									</div>
								</div>
								<div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour" data-parent="#accordion0">
									<div class="panel-body">
										<p>Our fruits and vegetables vendors have a quality check process in place to ensure quality of the items delivered is up to the mark. Do let us know within 4 days of order delivery if you’re not happy with the quality of the product received.</p>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading" id="headingfive">
									<div class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-target="#collapsefive" href="#" aria-expanded="false" aria-controls="collapsefive">
											Is it safe to use my debit/credit card to shop on Grockart?
										</a>
									</div>
								</div>
								<div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive" data-parent="#accordion0">
									<div class="panel-body">
										<p>Yes, it is. All transactions on Grofers are completed via secure payment gateways which is PCI and DSS compliant. We do not store your card details while performing any payment transaction at any given time.</p>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading" id="headingsix">
									<div class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-target="#collapsesix" href="#" aria-expanded="false" aria-controls="collapsesix">
											Can I schedule an order to my convenience?
										</a>
									</div>
								</div>
								<div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix" data-parent="#accordion0">
									<div class="panel-body">
										<p>Sure. At the checkout page, you can select a delivery slot of your choice.</p>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading" id="headingseven">
									<div class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-target="#collapseseven" href="#" aria-expanded="false" aria-controls="collapseseven">
											How can I make payments at Grockart?
										</a>
									</div>
								</div>
								<div id="collapseseven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingseven" data-parent="#accordion0">
									<div class="panel-body">
										<p>Grockart accepts multiple modes of payment. You can make online payments using credit cards, debit cards, netbanking, PayTM, PayU Money and Mobikwik Wallet. Cash on delivery (COD) is also available for orders less than Rs. 8000.</p>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading" id="headingeight">
									<div class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-target="#collapseeight" href="#" aria-expanded="false" aria-controls="collapseeight">
											How long do you take to initiate my refund?
										</a>
									</div>
								</div>
								<div id="collapseeight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingeight" data-parent="#accordion0">
									<div class="panel-body">
										<p>1) For pre-paid/online transactions the refunds will be credited/rolled back to your original mode of payment, i.e. within 5-7 working days for debit/credit card payments and 24-48 hours for other wallets. <br>
										2) The refund against Grockart cash used will be credited in the Grockart Wallet. For the remaining amount, the customer has the option to get the refund in his/her designated bank account via NEFT (for which the customer shall have to share the bank details) and in such a case the credit of refund into the designated bank account will take 7-10 working days. Otherwise, they can still choose to take the remaining refund in Grockart Wallet.</p>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading" id="headingnine">
									<div class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-target="#collapsenine" href="#" aria-expanded="false" aria-controls="collapsenine">
											What If I want to return something?
										</a>
									</div>
								</div>
								<div id="collapsenine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingnine" data-parent="#accordion0">
									<div class="panel-body">
										<p>If you’re dissatisfied with the products delivered, please register a complaint within 4 days for perishable items, 7 days for non-perishable items and 15 days for Home and Furnishing Needs items. Our customer support team will get in touch with you to resolve this issue. You can also return the products which you are dissatisfied with, at the time of delivery and we will get the refund initiated for you.</p>
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
@endsection
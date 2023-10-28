@extends('front/dashboardTemplate')
@section('orders_active','active')
@section('page_title','Grockart | Checkout Now')
@section('Dashboardcontainer')
	<!-- Body Start -->
	<div class="col-lg-9 col-md-8">
		<div class="dashboard-right">
			<div class="row">
				@if(session()->has('review_status'))
				<div class="col-md-12">
					<h6 class="text-capitalize text-center py-3 px-3 mb-4 mx-0" style="display: inline-block;border-radius: 5px;background: #f55d2c;color: #fff;">{{session()->get('review_status')}}</h6>
				</div>
				@endif
				<div class="col-lg-10 col-md-12">
					<div class="pdpt-bg mt-0">
						<div class="pdpt-title">
							<h4 style="font-weight: normal;" class="text-capitalize">describe your shopping expereince this time?</h4>
						</div>
						<form action="{{route('review.submit',['id'=> $review_id])}}" method="post" class="ddsh-body pr-md-5">
							@csrf
							<!-- <h2>6 Rewards</h2> -->
							<label class="pb-3">Thank you for your purchase. Please help us improve by taking this brief survey that asks you to share how you experienced our website.</label>
							<div class="form-group">
								<label class="control-label mb-0">Overall, how satisfied were you with your purchase experience today?</label>
								<div class="time-radio">
									<div class="ui form">
										<div class="grouped fields">
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" name="q1" required="" value="Very Satisfied" tabindex="0" class="hidden">
													<label>Very Satisfied</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" name="q1" value="Average" tabindex="0" class="hidden">
													<label>Average</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" name="q1" value="Dissatisfied" tabindex="0" class="hidden">
													<label>Dissatisfied</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label mb-0">How likely are you to recommend our site to a friend, family member, or colleague?</label>
								<div class="time-radio">
									<div class="ui form">
										<div class="grouped fields">
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" required="" name="q2" value="Sure" tabindex="0" class="hidden">
													<label>Sure</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" name="q2" value="Not Now" tabindex="0" class="hidden">
													<label>Not Now</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" name="q2" value="Never" tabindex="0" class="hidden">
													<label>Never</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label mb-0">How likely are you to purchase from us the next time you are in the market for the type of product you purchased today?</label>
								<div class="time-radio">
									<div class="ui form">
										<div class="grouped fields">
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" required="" name="q3" value="Very Likely" tabindex="0" class="hidden">
													<label>Very Likely</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" name="q3" value="Not at all" tabindex="0" class="hidden">
													<label>Not at all</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" name="q3" value="Need Some Improvement" tabindex="0" class="hidden">
													<label>Need Some Improvement</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label mb-0">Please tell us how our site compares to other sites that sell similar products for each of the items below.</label>
							</div>
							<div class="form-group">
								<label class="control-label mb-0">Clarity of product information on our website</label>
								<div class="time-radio">
									<div class="ui form">
										<div class="grouped fields">
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" required="" name="q4" value="Much Better" tabindex="0" class="hidden">
													<label>Much Better</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="About the same" name="q4" tabindex="0" class="hidden">
													<label>About the same</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Need Improvemnt" name="q4" tabindex="0" class="hidden">
													<label>Need Improvemnt</label>
												</div>
											</div>
										</div>
									</div>
								</div>		
							</div>
							<div class="form-group">
								<label class="control-label mb-0">Overall organization/navigation on our website</label>
								<div class="time-radio">
									<div class="ui form">
										<div class="grouped fields">
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Much Better" required="" name="q5" tabindex="0" class="hidden">
													<label>Much Better</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="About the same" name="q5" tabindex="0" class="hidden">
													<label>About the same</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Need Improvemnt" name="q5" tabindex="0" class="hidden">
													<label>Need Improvemnt</label>
												</div>
											</div>
										</div>
									</div>
								</div>		
							</div>
							<div class="form-group">
								<label class="control-label mb-0">Ease of ordering process on our website</label>
								<div class="time-radio">
									<div class="ui form">
										<div class="grouped fields">
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Much Better" required="" name="q6" tabindex="0" class="hidden">
													<label>Much Better</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="About the same" name="q6" tabindex="0" class="hidden">
													<label>About the same</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Need Improvemnt" name="q6" tabindex="0" class="hidden">
													<label>Need Improvemnt</label>
												</div>
											</div>
										</div>
									</div>
								</div>		
							</div>
							<div class="form-group">
								<label class="control-label mb-0">Product selection on our website</label>
								<div class="time-radio">
									<div class="ui form">
										<div class="grouped fields">
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Much Better" required="" name="q7" tabindex="0" class="hidden">
													<label>Much Better</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="About the same" name="q7" tabindex="0" class="hidden">
													<label>About the same</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Need Improvemnt" name="q7" tabindex="0" class="hidden">
													<label>Need Improvemnt</label>
												</div>
											</div>
										</div>
									</div>
								</div>		
							</div>
							<div class="form-group">
								<label class="control-label mb-0">Pricing of product on our website</label>
								<div class="time-radio">
									<div class="ui form">
										<div class="grouped fields">
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Much Better" required="" name="q8" tabindex="0" class="hidden">
													<label>Much Better</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="About the same" name="q8" tabindex="0" class="hidden">
													<label>About the same</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Need Improvemnt" name="q8" tabindex="0" class="hidden">
													<label>Need Improvemnt</label>
												</div>
											</div>
										</div>
									</div>
								</div>		
							</div>
							<div class="form-group">
								<label class="control-label mb-0">Shipping options on our website</label>
								<div class="time-radio">
									<div class="ui form">
										<div class="grouped fields">
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Much Better" required="" name="q9" tabindex="0" class="hidden">
													<label>Much Better</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="About the same" name="q9" tabindex="0" class="hidden">
													<label>About the same</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Need Improvemnt" name="q9" tabindex="0" class="hidden">
													<label>Need Improvemnt</label>
												</div>
											</div>
										</div>
									</div>
								</div>		
							</div>
							<div class="form-group">
								<label class="control-label mb-0">Customer service on our website</label>
								<div class="time-radio">
									<div class="ui form">
										<div class="grouped fields">
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Much Better" required="" name="q10" tabindex="0" class="hidden">
													<label>Much Better</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="About the same" name="q10" tabindex="0" class="hidden">
													<label>About the same</label>
												</div>
											</div>
											<div class="field">
												<div class="ui radio checkbox chck-rdio">
													<input type="radio" value="Need Improvemnt" name="q10" tabindex="0" class="hidden">
													<label>Need Improvemnt</label>
												</div>
											</div>
										</div>
									</div>
								</div>		
							</div>
							<div class="form-group">
								<label class="control-label mb-2">Customer service on our website</label>
								<textarea name="q11" class="form-control" rows="5" style="resize: none;"></textarea>
							</div>							
	                        @if(session()->has('review_status'))
	                        <div class="row">
	                            <div class="col-8">
									<button disabled="" data-tooltip="Review Already Submitted" data-inverted="" data-position="top center" class="post-btn hover-btn" name="feedback_btn" type="submit">Submit Feedback</button>
								</div>
								<div class="col-4">
									<button type="button" class="post-btn float-right hover-btn" onclick="window.location.href='/user/orders'">Back</button>
								</div>
	                        </div>
	                        @else
	                        <div class="row">
	                            <div class="col-lg-12">
									<button class="post-btn hover-btn" name="feedback_btn" type="submit">Submit Feedback</button>
								</div>
	                        </div>
	                        @endif
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Body End -->	
@endsection
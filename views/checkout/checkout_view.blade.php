@extends('frontend.main_master')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@section('title')
Wish List Page
@endsection


<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
	
    

    <!-- panel-heading -->

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

				<!-- guest-login -->			
				<div class="col-md-6 col-sm-6 already-registered-login">
					<h4 class="checkout-subtitle"><b>Shipping Address</b></h4>


					<form class="register-form" action="{{ route('checkout.store') }}" method="POST">
						@csrf


						<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Shipping Name <span>*</span></label>
					  
                        <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{ Auth::user()->name }}">
					  </div>{{-- //End Form Group--}}


<div class="form-group">
<label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>					  
<input type="email" name="email" 
class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{ Auth::user()->email }}">
</div>{{-- //End Form Group--}}

<div class="form-group">
<label class="info-title" for="exampleInputEmail1">Phone <span>*</span></label>
<input type="number" name="shipping_name" 
class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{ Auth::phone()->name }}" placeholder="Phone">
</div>{{-- //End Form Group--}}


<div class="form-group">
    <label class="info-title" for="exampleInputEmail1">Post Code <span>*</span></label>
    <input type="text" name="post_code" 
    class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Post Code">
    </div>{{-- //End Form Group--}}

				</div>
				<!-- guest-login -->

				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">
					


                    <div class="form-group">
                        <h5>Division Select <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="division_id"  required class="form-control">
                                <option value="" selected="" disabled="" >Select Your Division</option>
                                @foreach($division as $item)
                                <option value="{{ $item -> id }}">{{ $item ->division_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        @error('division_id')
                        <span class="text-danger">{{ $message}}</span>
                            
                        @enderror
                    </div>




                    <div class="form-group">
                        <h5>District Select <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="district_id"  required class="form-control">
                                <option value="" selected="" disabled="" >Select Your District</option>
                                
                            </select>
                        </div>
                        @error('district_id')
                        <span class="text-danger">{{ $message}}</span>
                            
                        @enderror
                    </div>




                    <div class="form-group">
                        <h5>Select State <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="state_id"  required class="form-control">
                                <option value="" selected="" disabled="" >Select Your State</option>
                                
                            </select>
                        </div>
                        @error('state_id')
                        <span class="text-danger">{{ $message}}</span>
                            
                        @enderror
                    </div>


                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Notes<span>*</span></label>

                        <textarea class="form-group" name="notes" cols="30" rows="5"></textarea>


                        {{-- <input type="text" name="notes" 
                        class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Notes"> --}}
                        </div>{{-- //End Form Group--}}

                      
					</form>
				</div>	
				<!-- already-registered-login -->		

			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!--End checkout-step-01  -->

					  	
					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Your Checkout Progress</h4>
		    </div>
		    <div class="">
				<ul class="nav nav-checkout-progress list-unstyled">
	
                    @foreach($carts as $item)
                    <li> 
                        <strong>Image:</strong>
                        <img src="{{ asset($item->options->image) }}" style="height:50px; width:50px;" alt="">
                    </li>
					
                    <li> 
                        <strong>Qty:</strong>
                        ({{ $item->qty }})

                        <strong>Colour:</strong>
                        {{ $item->option->color }}

                        <strong>size:</strong>
                        {{ $item->option->size }}
                    </li>

        <li>
            @if(Session::has('coupon'))

            <strong>SubTotal: </strong>${{$cartTotal}}<hr>

            <strong>Coupon Name: </strong> {{session()->get('coupon')['coupon_name']}} <hr>
({{ session()->get('coupon')['coupon_discount'] }}%)

<strong>Coupon Discount: </strong> ${{session()->get('coupon')['discount_amount']}} <hr>


<strong>Grand Total: </strong> ${{session()->get('coupon')['total_amount']}} <hr>

            @else
            <strong>SubTotal: </strong>${{$cartTotal}}<hr>


            <strong>Coupon Name </strong>${{$cartTotal}}<hr>

            @endif

        </li>
					
                    @endforeach()
                    
                
                </ul>		
			</div>
		</div>
	</div>
</div> 
<!-- checkout-progress-sidebar -->				
</div>


<div class="col-md-4">
	<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="unicase-checkout-title">Select Payment Methods</h4>
</div>
		<div class="row">
				
			<div class="col-md-4">
				<label for="">Stripe</label>
				<input type="radio" name="payment_method" value="stripe">
				<img src="{{ asset('frontend/asset/images/payments/4.png') }}" >
			</div>{{-- End Col --}}

			<div class="col-md-4">
				<label for="">Card</label>
				<input type="radio" name="payment_method" value="card">
				<img src="{{ asset('frontend/asset/images/payments/3.png') }}" >
			</div>{{-- End Col --}}

			<div class="col-md-4">
				<label for="">Cash</label>
				<input type="radio" name="payment_method" value="cash">
				<img src="{{ asset('frontend/asset/images/payments/2.png') }}" >
			</div>{{-- End Col --}}	

		</div>{{-- End Row --}}


		<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment</button>

</div>
</div>
</div> 
<!-- checkout-progress-sidebar -->				
</div>




			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">

		<div class="logo-slider-inner">	
			<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
				<div class="item m-t-15">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item m-t-10">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->
		    </div><!-- /.owl-carousel #logo-slider -->
		</div><!-- /.logo-slider-inner -->
	
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->



<script type="text/javascript">
	$(document).ready(function() {
			$('select[name="division_id"]').on('change', function(){
				var division_id = $(this).val();
				if(division_id) {
					$.ajax({
						url: "{{  url('/district-get/ajax') }}/"+division_id,
						type:"GET",
						dataType:"json",
						success:function(data) {
							$('select[name="state_id"]').empty();
						   var d =$('select[name="district_id"]').empty();
							  $.each(data, function(key, value){
								  $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
							  });
						},
					});
				} else {
					alert('danger');
				}
			});

			$('select[name="district_id"]').on('change', function(){
				var district_id = $(this).val();
				if(district_id) {
					$.ajax({
						url: "{{  url('/state-get/ajax') }}/"+district_id,
						type:"GET",
						dataType:"json",
						success:function(data) {
						   var d =$('select[name="state_name"]').empty();
							  $.each(data, function(key, value){
								  $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
							  });
						},
					});
				} else {
					alert('danger');
				}
			});


		});
	</script>








@endsection
@extends('frontend.main_master')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@section('title')
Stripe Page
@endsection

<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;
  height: 40px;
  padding: 10px 12px;
  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}
.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}
.StripeElement--invalid {
  border-color: #fa755a;
}
.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;}
</style>




<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				
				<div class="col-md-6">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Your Shopping Amount</h4>
		    </div>
		    <div class="">
				<ul class="nav nav-checkout-progress list-unstyled">
	
                    

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


<div class="col-md-6">
	<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="unicase-checkout-title">Select Payment Methods</h4>
</div>
<form action="{{ route('stripe.order') }}" method="post" id="payment-form">
    @csrf
<div class="form-row">
    <label for="card-element">
    <input type="text" name="name" value="{{ $data['shipping_name'] }}">
    <input type="email" name="email" value="{{ $data['shipping_email'] }}">
    <input type="text" name="phone" value="{{ $data['shipping_phone'] }}">
    <input type="text" name="post_code" value="{{ $data['psot_code'] }}">
    <input type="text" name="division_id" value="{{ $data['division_id'] }}">
    <input type="text" name="district_id" value="{{ $data['district_id'] }}">
    <input type="text" name="state_id" value="{{ $data['state_id'] }}">
    <input type="text" name="notes" value="{{ $data['notes'] }}">
    {{-- <input type="text" name="name" value="{{ $data['shipping_name'] }}">
    <input type="text" name="name" value="{{ $data['shipping_name'] }}"> --}}
    
    </label>
     
    <div id="card-element">
    <!-- A Stripe Element will be inserted here. -->
    </div>
    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>
</div>
<br>
<button class="btn btn-primary">Submit Payment</button>
</form>


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
    // Create a Stripe client.
var stripe = Stripe('pk_test_51KlpgySCJu1vZ2fWWmf3QkdYzYlcjUa3ZMddCSPa9P7vxl6bkTT2np32IjkXoGjiDUtF4dgvHDvqQhmFJKStAIWs00YP95uZDU');
// Create an instance of Elements.
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};
// Create an instance of the card Element.
var card = elements.create('card', {style: style});
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});
// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
  // Submit the form
  form.submit();
}
</script>

@endsection
@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Checkout</h2>
		</div>
	</div>

	@if (Session::has('cart_message'))
		<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
		@php Session::forget('cart_message'); @endphp
	@endif
	<style type="text/css">
		.wpwl-container{
			margin-left: 150px;
		}
	</style>
	<div class="carrito">
		<div class="container">
			<div class="crt-rep">
					<div class="row align-items-center">
						    <div class="container-fluid">
        <div class="creditCardForm">
            <div class="heading">
                <h1></h1>
            </div>
            <div class="payment">
                    
            <form action="{{url('online_payment')}}" class="paymentWidgets" data-brands="VISA MASTER"></form>

            </div>
        </div>
    </div> 
					</div>
			</div> 
		</div> 
	</div> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
        //setTimeout(() => $('.wpwl-form:first').remove(),1000)
        var wpwlOptions = {
            registrations: {requireCvv: false,hideInitialPaymentForms: false},           
            onReady: function() {
                var numberOfInstallmentsHtml = '';
                numberOfInstallmentsHtml += `<div class="wpwl-group wpwl-group-billingCity wpwl-clearfix" style="width:45%;">
                      
                        <label for="Name" class="wpwl-label">Billing City</label>
                        <input type="text" required class="wpwl-control" id="billing.city" name="billing.city">
                      </div>
                      <div class="wpwl-group wpwl-group-billingCountry wpwl-clearfix" style="width:48%;margin-left: 25px;">
                        <label for="Email" class="wpwl-label">Billing Country</label>
                        <input type="email" required class="wpwl-control" id="billing.country" name="billing.country">
                      </div>
                    </div>`;


            numberOfInstallmentsHtml += `<div class="wpwl-group wpwl-group-billingCity wpwl-clearfix" style="width:45%;">
                      
                        <label for="Name" class="wpwl-label">Billing Street</label>
                        <input type="text" required class="wpwl-control" id="billing.street1" name="billing.street1">
                      </div>
                      <div class="wpwl-group wpwl-group-billingCountry wpwl-clearfix" style="width:48%;margin-left: 25px;">
                        <label for="Email" required class="wpwl-label">Billing Postcode</label>
                        <input type="email" class="wpwl-control" id="billing.postcode" name="billing.postcode">
                      </div>
                    </div>`;

           numberOfInstallmentsHtml += `<div class="wpwl-group wpwl-group-billingCity wpwl-clearfix" style="width:100%;">
                      
                        <label for="Name" class="wpwl-label">Customer Email</label>
                        <input type="text" required class="wpwl-control" id="customer.email" name="customer.email">
                      </div>`; 
          
           
 
            $('form.wpwl-form-card').find('.wpwl-button').before(numberOfInstallmentsHtml);
            } 
        }
    </script>
    <script async src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$data['id']}}"></script>
@stop
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
                    
            <form action="{{url('online_payment')}}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>

            </div>
        </div>
    </div> 
					</div>
			</div> 
		</div> 
	</div> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
        setTimeout(() => $('.wpwl-form:first').remove(),1000)
        var wpwlOptions = {    registrations: {        requireCvv: false,        hideInitialPaymentForms: false    }}
    </script>
    <script async src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$data['id']}}"></script>
@stop
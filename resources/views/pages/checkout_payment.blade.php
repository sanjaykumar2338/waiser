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
			<div class="row hide-mb">
				<div class="col-md-12">
					<h2 class="title">Carrito</h2>
				</div>
			</div>
			<div class="crt-rep">
					<div class="row align-items-center">
						<div class="">
							<div class="prd-crt">
								<div class="d-flex flex-wrap prd-inner">
									 <form action="{{url('online_payment')}}" method="get" class="paymentWidgets" data-brands="VISA MASTER AMEX">
									 	@csrf
									 </form>
								</div> 
							</div> 
						</div> 
					</div>
			</div> 
		</div> 
	</div> 

	<script src="https://code.jquery.com/jquery.js" type="text/javascript"></script>
	<script type="text/javascript">
		setTimeout(() => $('.wpwl-form:first').remove(),1000)
	  	var wpwlOptions = {    registrations: {        requireCvv: false,        hideInitialPaymentForms: false    }}
    </script>
    <script async src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId=6847A2F24217BC57D82013B335EF2310.uat01-vm-tx01"></script>
@stop
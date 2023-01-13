@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Checkout</h2>
		</div>
	</div>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assests/payment_form/css/styles.css')}}">
    <link rel="stylesheet" type="text/css" href="asset('public/assests/payment_form/css/demo.css')}}">

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
                <h1>Pago</h1>
            </div>
            <div class="payment" name="payment_frm" method="post" action="{{url('online_payment')}}">
                <form>
                	@csrf
                    <div class="form-group owner">
                        <label for="owner">Nombre del Tarjetahabiente</label>
                        <input type="text" class="form-control" id="owner">
                    </div>
                    <div class="form-group CVV">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv">
                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Número de tarjeta</label>
                        <input type="text" class="form-control" id="cardNumber">
                    </div>
                    <div class="form-group" id="expiration-date">
                        <label>Fecha de vencimiento</label>
                        <select>
                            <option value="01">Enero</option>
                            <option value="02">Febrero </option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Deciembre</option>
                        </select>
                        <select>
                            <option value="23"> 2023</option>
                            <option value="24"> 2024</option>
                            <option value="25"> 2025</option>
                            <option value="26"> 2026</option>
                            <option value="27"> 2027</option>
                            <option value="28"> 2028</option>
                        </select>
                    </div>
                    <div class="form-group" id="credit_cards">
                        <img src="{{asset('public/assests/payment_form/images/visa.jpg')}}" id="visa">
                        <img src="{{asset('public/assests/payment_form/images/mastercard.jpg')}}" id="mastercard">
                        <img src="{{asset('public/assests/payment_form/images/amex.jpg')}}" id="amex">
                    </div>
                    <div class="form-group" id="pay-now">
                        <button type="submit" class="btn btn-default" id="confirm-purchase">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
					</div>
			</div> 
		</div> 
	</div> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('public/assests/payment_form/js/jquery.payform.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('public/assests/payment_form/js/script.js')}}"></script>
@stop
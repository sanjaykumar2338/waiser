@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Pago</h2>
		</div>
	</div>
	@if (Session::has('cart_message'))
		<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
		@php Session::forget('cart_message'); @endphp
	@endif
	<div class="carrito">
		<div class="container">
			<div class="row hide-mb">
				<div class="col-md-12">
					<h2 class="title">Resumen</h2>
				</div>
			</div>
			<div class="crt-rep">
			<div class="row align-items-center">
				<div class="col-md-9 col-8">
					<div class="prd-crt">
						<div class="d-flex flex-wrap prd-inner">
							<div class="prd-img">
								<img src="{{ asset('public/assests/images/prd-1.jpg')}}"/>
							</div> 
							<div class="prd-content">
								<h2 class="brd-color">Descricpión del curso 1</h2>
								<h2>Nombre Apellido1 Apellido2</h2>
								<span class="prd-tm">16:40 a 15:40  Lunes y Míercoles </span>
								<p>Inicia: 10/01/2022   Finaliza: 10/06/2022  </p>
								<p>Sede:  CDI    </p>
								<p>Profesor:  Adrián Olvera</p>
							</div> 
						</div> 
					</div> 
				</div> 
				<div class="col-md-3 col-4">
					<div class="prd-right">
						<div class="d-flex justify-content-between align-items-center">
							<div class="prd-price">
								<h3>$4,340.00</h3>
							</div>
							<div class="prd-cross">
								<a class="prd-dlt" href="#"><img src="{{ asset('public/assests/images/delete.svg')}}"></a>
							</div>
						</div> 
					</div> 
				</div> 
			</div> 
			<div class="row">
				<div class="col-md-9 col-8">
					<div class="prd-crt">
						<div class="d-flex flex-wrap prd-inner">
							<div class="prd-img">
								<img src="{{ asset('public/assests/images/prd-1.jpg')}}"/>
							</div> 
							<div class="prd-content">
								<h2 class="brd-color">Descricpión del curso 1</h2>
								<h2>Nombre Apellido1 Apellido2</h2>
								<span class="prd-tm">16:40 a 15:40  Lunes y Míercoles </span>
								<p>Inicia: 10/01/2022   Finaliza: 10/06/2022  </p>
								<p>Sede:  CDI    </p>
								<p>Profesor:  Adrián Olvera</p>
							</div> 
						</div> 
					</div> 
				</div> 
				<div class="col-md-3 col-4">
					<div class="prd-right">
						<div class="d-flex justify-content-between">
							<div class="prd-price">
								<h3>$6,500.00</h3>
							</div>
							<div class="prd-cross">
								<a class="prd-dlt" href="#"><img src="{{ asset('public/assests/images/delete.svg')}}"></a>
							</div>
						</div> 
					</div> 
				</div> 
			</div> 
			</div> 
		</div> 
	</div> 
	<div class="carrito-cupn hide-mb">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-7">
				</div>
				<div class="col-md-5">
					<div class="subtotal">
						<table>
							<tr>
								<td>Subtotal</td>
								<td><strong>$10,840.00</strong></td>
							</tr>
							<tr>
								<td>Cobertura </br>deportiva x 1</td>
								<td><strong>$326.00</strong></td>
							</tr>
							<tr>
								<td>Descuentos</td>
								<td><strong>-$100.00</strong></td>
							</tr>
							<tr>
								<td>Total </td>
								<td><strong>$11,066.00</strong></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-info ">
		<div class="container">
			<div class="card-dtl">
				<form>
					<div class="row">
						<div class="col-md-12">
							<div class="form-field">
								<label>Número de tarjeta</label>
								<div class="numero">
									<input type="text" placeholder="0000 0000 0000 0000"/>
									<img src="{{ asset('public/assests/images/mastrcard.svg')}}"/>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-field">
								<input type="text" placeholder="MM/YY"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-field">
								<input type="text" placeholder="CVC"/>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-field">
								<label>Nombre  del titular de la tarjeta</label>
								<input type="text" placeholder="Name"/>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-sbt">
								<input type="submit" value="Pagar"/>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
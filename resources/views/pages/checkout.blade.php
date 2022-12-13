@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Checkout</h2>
		</div>
	</div>
	<div class="carrito">
		<div class="container">
			<div class="row hide-mb">
				<div class="col-md-12">
					<h2 class="title">Carrito</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9 col-8">
					<h4 class="pd-sm-title">CURSO</h4>
				</div>
				<div class="col-md-3 col-4">
					<h4 class="pd-sm-title">PRECIO</h4>
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
					<div class="cupon">
						<h3>CUPONES</h3>
						<form>
							<div class="coupon-field">
								<input type="text" placeholder="Ingresar cupón"/>
								<button>Agregar</button>
							</div>
						</form>
					</div>
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
	<div class="carrito-info hide-mb">
		<div class="container">
			<div class="carrito-chck">
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
					<label class="custom-control-label" for="customCheck1">Acepto los términos y condiciones de  los cursos.  <a href="#">Ver</a></label>
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="customCheck2">
					<label class="custom-control-label" for="customCheck2">Acepto los reglamentos de los cursos.  <a href="#">Ver</a></label>
				</div>
			</div>
			<div class="reserva-bx">
				<h3>Reserva y paga después </h3>
				<p>El lugar se reserva por 48 horas. Se puede pagar en las cajas del Depor o por medio esta página en la sección de Mis inscripciones.</p>
				<a href="#">Reservar y pagar después</a>
			</div>
			<div class="reserva-bx">
				<h3>Reserva y paga en linea ahora</h3>
				<p>Formas de pago.</p>
				<a href="#">Reservar y pagar ahora en línea</a>
			</div>
		</div>
	</div>
@stop
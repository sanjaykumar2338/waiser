@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Mis inscripciones</h2>
		</div>
	</div>
	@if (Session::has('cart_message'))
		<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
		@php Session::forget('cart_message'); @endphp
	@endif
	<div class="carrito">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="mid-title">INCRIPCIONES PAGADAS</h2>
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
									<h2 class="brd-color">Descricpión del curso 4</h2>
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
							<div class="d-flex justify-content-end align-items-center">
								<p class="pagado">Pagado <img src="{{ asset('public/assests/images/check-circle.svg')}}"></p>
							</div> 
						</div> 
					</div> 
				</div> 
			</div> 
		</div> 
	</div> 
	<div class="incrip">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="mid-title">INCRIPCIONES PENDIENTES DE PAGO</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p class="seleccionar">Seleccionar </p>
				</div>
			</div>
			<div class="crt-rep">
				<div class="row align-items-center">
					<div class="col-md-9 col-8 d-flex align-items-center">
						<div class="cst-chk">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
								<label class="custom-control-label" for="customCheck1"></label>
							</div>
						</div>
						<div class="prd-crt">
							<div class="d-flex flex-wrap prd-inner">
								<div class="prd-img">
									<img src="{{ asset('public/assests/images/prd-1.jpg')}}"/>
								</div> 
								<div class="prd-content">
									<h2 class="brd-color">Descricpión del curso 5</h2>
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
							<div class="d-flex justify-content-end">
								<p class="pagado">Pago pendiente <img src="{{ asset('public/assests/images/yellow-circule.svg')}}"></p>
							</div> 
						</div> 
					</div> 
				</div> 
				<div class="row align-items-center">
					<div class="col-md-9 col-8 d-flex align-items-center">
						<div class="cst-chk">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
								<label class="custom-control-label" for="customCheck1"></label>
							</div>
						</div>
						<div class="prd-crt">
							<div class="d-flex flex-wrap prd-inner">
								<div class="prd-img">
									<img src="{{ asset('public/assests/images/prd-1.jpg')}}"/>
								</div> 
								<div class="prd-content">
									<h2 class="brd-color">Descricpión del curso 6</h2>
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
							<div class="d-flex justify-content-end">
								<p class="pagado">Pago pendiente <img src="{{ asset('public/assests/images/yellow-circule.svg')}}"></p>
							</div> 
						</div> 
					</div> 
				</div> 
			</div>
			<div class="pay-btns text-right">
				<a class="cart-btn " href="#">Pagar cursos seleccionados</a>
			</div>
		</div>
	</div>
@stop
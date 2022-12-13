@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Descripción del curso 1</h2>
		</div>
	</div>
	<div class="prd-main">
		<div class="cl-tp hide-mb">
			<div class="container">
				<p>Socio seleccionado: <strong>Nombre Apellido Apellido</strong></p>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="product-img">
						<img src="{{ asset('public/assests/images/product-1.jpg')}}"/>
						<a class="cart-btn red-btn hide-mb" href="#">Regresar y elegir otro</a>
					</div>
				</div>
				<div class="col-md-7">
					<div class="product-detail">
						<div class="d-flex flex-wrap align-items-center justify-content-between prd-prc">
							<h3>Precio: $4,340.00</h3>
							<p class="lugares"><span></span>8 LUGARES DISPONIBLES DE 10</p>
						</div>
						<ul>
							<li>HORARIO:<strong>16:40 a 18:10 Lun. Mie</strong></li>
							<li>ciclo:<strong>PERIODO ANUAL FOMENTO DEPORTIVO 2022-2023</strong></li>
							<li>COORDINACIÓN:<strong>FUTBOL</strong></li>
							<li>inicio del curso:<strong>10/01/2023</strong></li>
							<li>fin del curso:<strong>10/06/2023</strong></li>
							<li>sede:<strong>CDI</strong></li>
							<li>ESPACIO:<strong>CAMPFUT1</strong></li>
							<li>profesor:<strong>RENE CHAVEZ</strong></li>
							<li>género:<strong>MASCULINO</strong></li>
							<li>edad máxima:<strong>10</strong></li>
							<li>edad mínima:<strong>6</strong></li>
							<li>nivel:<strong>ENSEÑANZA</strong></li>
							<li>requiere cobertura médica:<strong>SI</strong></li>
							<li>PAQUETE:<strong>98003</strong></li>
						</ul>
						<a class="cart-btn blue-btn" href="#">Agregar al carrito</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
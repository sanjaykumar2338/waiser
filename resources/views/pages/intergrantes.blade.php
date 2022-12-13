@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Selecciona el integrante de tu familia que deseas inscribir</h2>
			<p class="hide-mb">Puedes repetir este proceso para todas las inscripciones que necesites</p>
		</div>
	</div>
	<div class="intergrante-main">
		<div class="container">
			<div class="row">
				<div class="cloumn-five">
					<div class="intergrante-box">
						<div class="intergrante-img">
							<img src="{{ asset('public/assests/images/integra-1.jpg')}}"/>
						</div>
						<div class="intergrante-contnet">
							<h3>Nombre del papá</h3>
							<p>Número de socio: 2111100</p>
							<p>Edad:  40 años</p>
							<p>Sexo: Masculino</p>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				<div class="cloumn-five">
					<div class="intergrante-box">
						<div class="intergrante-img">
							<img src="{{ asset('public/assests/images/integra-2.jpg')}}"/>
						</div>
						<div class="intergrante-contnet">
							<h3>Nombre de la mamá</h3>
							<p>Número de socio: 2111101</p>
							<p>Edad:  32 años</p>
							<p>Sexo: Femenino</p>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				<div class="cloumn-five">
					<div class="intergrante-box">
						<div class="intergrante-img">
							<img src="{{ asset('public/assests/images/integra-3.jpg')}}"/>
						</div>
						<div class="intergrante-contnet">
							<h3>Nombre del hijo 1</h3>
							<p>Número de socio: 2111102</p>
							<p>Edad:  10 años</p>
							<p>Sexo: Masculino</p>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				<div class="cloumn-five">
					<div class="intergrante-box">
						<div class="intergrante-img">
							<img src="{{ asset('public/assests/images/integra-4.jpg')}}"/>
						</div>
						<div class="intergrante-contnet">
							<h3>Nombre del hijo 2</h3>
							<p>Número de socio: 2111103</p>
							<p>Edad:  8 años</p>
							<p>Sexo: Masculino</p>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				<div class="cloumn-five">
					<div class="intergrante-box">
						<div class="intergrante-img">
							<img src="{{ asset('public/assests/images/integra-5.jpg')}}"/>
						</div>
						<div class="intergrante-contnet">
							<h3>Nombre del hijo 3</h3>
							<p>Número de socio: 2111104</p>
							<p>Edad:  5 años</p>
							<p>Sexo:  Femenino</p>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>

	<div class="image-gallery d-flex">
		<div class="img-bx">
			<img src="{{ asset('public/assests/images/img-1.jpg')}}"/>
		</div>
		<div class="img-bx">
			<img src="{{ asset('public/assests/images/img-2.jpg')}}"/>
		</div>
		<div class="img-bx">
			<img src="{{ asset('public/assests/images/img-3.jpg')}}"/>
		</div>
		<div class="img-bx">
			<img src="{{ asset('public/assests/images/img-4.jpg')}}"/>
		</div>
		<div class="img-bx">
			<img src="{{ asset('public/assests/images/img-5.jpg')}}"/>
		</div>
		<div class="img-bx">
			<img src="{{ asset('public/assests/images/img-6.jpg')}}"/>
		</div>
	</div>  
@stop
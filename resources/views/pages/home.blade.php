@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Selecciona el deporte o actividad</h2>
		</div>
	</div>
	<div class="socio">
		<div class="container">
			<div class="socio-top">
				<div class="row align-itmes-center">
					<div class="col-md-7">
						<div class="socio-left d-flex flex-wrap align-itmes-center">
							<p>Socio seleccionado: <strong>Nombre Apellido Apellido</strong></p>
							<span class="hgh-color">Cambiar</span>
						</div>
					</div>
					<div class="col-md-5">
						<div class="socio-right">
							<form>
								<div class="from-srch">
									<input type="text" placeholder="BUSCAR"/>
									<button><img src="{{ asset('public/assests/images/Search_light.svg')}}"></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-6">
					<div class="socio-box">
						<div class="socio-img">
							<img src="{{ asset('public/assests/images/bg.jpg')}}"/>
						</div>
						<div class="socio-contnet">
							<h3>futbol soccer</h3>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-6">
					<div class="socio-box">
						<div class="socio-img">
							<img src="{{ asset('public/assests/images/bg.jpg')}}"/>
						</div>
						<div class="socio-contnet">
							<h3>gimnasia</h3>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-6">
					<div class="socio-box">
						<div class="socio-img">
							<img src="{{ asset('public/assests/images/bg.jpg')}}"/>
						</div>
						<div class="socio-contnet">
							<h3>NATACIÓN</h3>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-6">
					<div class="socio-box">
						<div class="socio-img">
							<img src="{{ asset('public/assests/images/bg.jpg')}}"/>
						</div>
						<div class="socio-contnet">
							<h3>DANZA</h3>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				
				<div class="col-md-3 col-6">
					<div class="socio-box">
						<div class="socio-img">
							<img src="{{ asset('public/assests/images/bg.jpg')}}"/>
						</div>
						<div class="socio-contnet">
							<h3>robótica</h3>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-6">
					<div class="socio-box">
						<div class="socio-img">
							<img src="{{ asset('public/assests/images/bg.jpg')}}"/>
						</div>
						<div class="socio-contnet">
							<h3>tenis</h3>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-6">
					<div class="socio-box">
						<div class="socio-img">
							<img src="{{ asset('public/assests/images/bg.jpg')}}"/>
						</div>
						<div class="socio-contnet">
							<h3>voleibol</h3>
							<a href="#">Seleccionar</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-6">
					<div class="socio-box">
						<div class="socio-img">
							<img src="{{ asset('public/assests/images/bg.jpg')}}"/>
						</div>
						<div class="socio-contnet">
							<h3>manualidades</h3>
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
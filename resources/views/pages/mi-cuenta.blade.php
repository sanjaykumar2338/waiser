@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Mi cuenta</h2>
		</div>
	</div>
	<div class="cuenta">
		<div class="container">
			<div class="cuenta-inf">
				<h2 class="title">Información</h2>
				<p>Nombre:</p>
				<p>Número de socio:</p>
				<p>Correo Electrónico:</p>
			</div> 
			<div class="cuenta-frm">
				<h2 class="title">Contraseña</h2>
				<form>
					<div class="cu-field">
						<div class="row">
							<div class="col-md-6">
								<label>Nueva contraseña:</label>
							</div>
							<div class="col-md-6">
								<input type="text" placeholder=""/>
							</div>
						</div>
					</div>
					<div class="cu-field">
						<div class="row">
							<div class="col-md-6">
								<label>Confirmar nueva contraseña:</label>
							</div>
							<div class="col-md-6">
								<input type="text" placeholder=""/>
							</div>
						</div>
					</div>
					<div class="form-sbt text-right">
						<input type="submit" value="Guardar"/>
					</div>
				</form>
			</div> 
		</div> 
	</div> 
@stop
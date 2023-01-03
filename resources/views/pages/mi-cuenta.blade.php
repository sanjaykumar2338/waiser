@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Mi cuenta</h2>
		</div>
	</div>
	@if (Session::has('cart_message'))
		<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
		@php Session::forget('cart_message'); @endphp
	@endif
	<div class="cuenta">
		<div class="container">
			<div class="cuenta-inf">
				<h2 class="title">Información</h2>
				<p>Nombre: {{Session::get('member_name')}}</p>
				<p>Número de socio: {{Session::get('user_id')}}</p>
				<p>Correo Electrónico: {{Session::get('member_email')}}</p>
			</div> 
			<div class="cuenta-frm">
				<h2 class="title">Contraseña</h2>
				<form name="change_frm" method="post" action="{{url('update_password')}}">
					@csrf
					<div class="cu-field">
						<div class="row">
							<div class="col-md-6">
								<label>Nueva contraseña:</label>
							</div>
							<div class="col-md-6">
								<input type="password" name="password" placeholder="Contraseña" id="password" required>
							</div>
						</div>
					</div>
					<div class="cu-field">
						<div class="row">
							<div class="col-md-6">
								<label>Confirmar nueva contraseña:</label>
							</div>
							<div class="col-md-6">
								<input type="password" name="confirm_password" placeholder="Confirmar contraseña" id="confirm_password" required>
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

	<script type="text/javascript">
		var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

		function validatePassword(){
		  if(password.value != confirm_password.value) {
		    confirm_password.setCustomValidity("Passwords Don't Match");
		  } else {
		    confirm_password.setCustomValidity('');
		  }
		}

		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
	</script>
@stop
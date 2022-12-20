@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero forgot-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Recuperación de contraseña  y </br>correo electrónico </h2>
		</div>
	</div>
	<div class="forgot-main">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="frg-box">
						<h2>Olvidé mi contraseña</h2>
						<p>Ingresa el correo electrónico asosiado a tu número de socio</p>
						<form name="email_frm" method="post" action="{{url('/')}}/recovery_by_email">
							@csrf
							<div class="fg-field">
								<label>Correo Electrónico</label>
								<input type="text" name="email" placeholder="Ingresar Correo Electrónico"/>
								<button type="submit" class="enviar-btn">enviar</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-6">
					<div class="frg-box">
						<h2>Recuperar Email asociado a mi cuenta</h2>
						<p>Ingresa tu número de socio (7 dígitos) por ejemplo 35945-00</p>
						<form name="socio_frm" method="post" action="{{url('/')}}/recovery_by_socio">
							@csrf
							<div class="fg-field">
								<label>Número de socio (7 dígitos)</label>
								<input type="text" name="socio" placeholder="Ingresar número de socio"/>
								<button type="submit" class="enviar-btn">enviar</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-12">
					<div class="frg-btn">
						<button class="enviar-btn">regresar</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$('.crt-btn').hide();
	</script>
@stop
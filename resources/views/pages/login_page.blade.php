@extends('layouts.homepage')
@section('content')
	<div class="login-page">
		<div class="container">
			<div class="row row-reverse-mb">
				<div class="col-md-6">
					<div class="lgn-content">
						<img class="lgn-logo hide-mb" src="{{ asset('public/assests/images/logo.svg')}}">
						<h3 class="hide-mb">Ingresar</h3>
						<h3 class="hide-ds"><span>Inscripción a Cursos</span> Acceder</h3>
						<form name="login_frm" method="post" action="{{url('/login_submit')}}">
							@csrf
							<div class="lgn-field">
								<label class="hide-mb">Email</label>
								<div class="lg-ff">
									<input name="email" type="text" placeholder="Ingresa tu correo electrónico,  o número de socio">
									<img class="lg-lft-ic hide-mb" src="{{ asset('public/assests/images/message 1.svg')}}">
								</div>
								<div class="tx-hg hide-mb">Recuperar el correo electrónico asociado a mi número de socio</div>
							</div>
							<div class="lgn-field">
								<label class="hide-mb">Contraseña</label>
								<div class="lg-ff">
									<input name="password" type="text" placeholder="Ingresa tu contraseña">
									<img class="lg-lft-ic hide-mb" src="{{ asset('public/assests/images/padlock 1.svg')}}">
									<img class="lg-rgt-ic hide-mb" src="{{ asset('public/assests/images/invisible 1.svg')}}">
								</div>
								<div class="tx-hg hide-mb">Olvidé mi contraseña</div>
							</div>
							<div class="lgn-sbt">
								<input type="submit" value="Ingresar"/>
							</div>
							<div class="forgot-pass hide-ds">
								<a href="#">Ólvide mi contraseña</a>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-6">
					<div class="lgn-img">
						<img src="{{ asset('public/assests/images/login-img.jpg')}}">
					</div>
				</div>
			</div>
		</div>
</div>

<script type="text/javascript">
	$('.crt-btn').hide();
</script>

@stop
@extends('professor.layouts.homepage')
@section('content')
	
	@if (Session::has('cart_message'))
		<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
		@php Session::forget('cart_message'); @endphp
	@endif


	<div class="login-page">
		<div class="container">
			<div class="row row-reverse-mb">
				<div class="col-md-6">
					<div class="lgn-content">
						<img class="lgn-logo hide-mb" src="{{ asset('public/assests/images/logo.svg')}}">
						<h3 class="hide-mb" style="font-size:28px;">Acceso profesores equipos representativos</h3>
						<h3 class="hide-ds"><span>Inscripción a Cursos</span> Acceder</h3>
						<form name="login_frm" method="post" action="{{url('/login_professor_submit')}}">
							@csrf
							<div class="lgn-field">
								<label class="hide-mb">Email</label>
								<div class="lg-ff">
									<input name="email" required type="text" placeholder="Ingresa tu correo electrónico">
									<img class="lg-lft-ic hide-mb" src="{{ asset('public/assests/images/message 1.svg')}}">
								</div>
							</div>
							<div class="lgn-field">
								<label class="hide-mb">Contraseña</label>
								<div class="lg-ff">
									<input name="password" required type="password" id="password" placeholder="Ingresa tu contraseña (Número de profesor)">
									<img class="lg-lft-ic hide-mb" src="{{ asset('public/assests/images/padlock 1.svg')}}">
									<img class="lg-rgt-ic hide-mb togglePassword" src="{{ asset('public/assests/images/invisible 1.svg')}}">
								</div>
							</div>
							<div class="lgn-sbt">
								<input type="submit" value="Ingresar"/>
							</div>
							<div class="forgot-pass hide-ds">
								<a href="{{url('/')}}/forget">Ólvide mi contraseña</a>
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
	$('.header').hide();

	const togglePassword = document.querySelector(".togglePassword");
    const password = document.querySelector("#password");
  
    togglePassword.addEventListener("click", function () {
        // toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        
        // toggle the icon
        //this.classList.toggle("bi-eye");
    });
</script>

@stop
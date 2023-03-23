<div class="header">
	<div class="top-bar">
			<div class="container">
				@if(Session::has('professor_email'))
				<ul class="d-flex flex-wrap align-itmes-center justify-content-end">
					<li><a href="{{url('/')}}/profesores/logout">SALIR</a></li>
				</ul>
				@endif
			</div>
	</div>
	<div class="navigation">
			<div class="container">
				<nav class="navbar navbar-expand-md" >
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<img src="{{ asset('public/assests/images/bar.svg')}}">
				  </button>
				  <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('public/assests/images/logo.svg')}}"></a>
				  
				  <div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav" style="display:none;">
						@if(Session::has('user_id'))
					  <li class="nav-item">
						<a class="nav-link active" href="{{url('/my_account')}}">INICIO</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="{{url('/my_account')}}">NUEVA INSCRIPCIÓN</a>
					  </li>
					  @endif
					  <li class="nav-item">
						<a class="nav-link" href="{{url('/mis-inscripciones')}}">MIS INSCRIPCIONES</a>
					  </li>    
					</ul>
				  </div>
				</nav>
			</div>
	</div>
</div>
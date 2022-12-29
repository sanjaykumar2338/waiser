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

				@if($members)
					@foreach($members as $member)
						@if($member->Parentesco=='Titular')
							<div class="cloumn-five">
								<div class="intergrante-box">
									<div class="intergrante-img">
										@if($member->image_url=="")
											<img height="212" src="{{ asset('public/assests/images/avtar.jpg')}}"/>
										@else
											<img height="212" src="{{ $member->image_url }}"/>
										@endif
									</div>
									@php
										$dob=date('Y', strtotime($member->FechaNacimiento));
									    $diff = (date('Y') - $dob);
									@endphp
									<div class="intergrante-contnet">
										<h3>{{$member->Nombre}}</h3>
										<p>Número de socio: {{$member->Socio}}</p>
										<p>Edad:  {{$diff}} años</p>
										<p>Sexo: {{$member->Sexo}}</p>
										<a href="{{url('/course_selection')}}/{{$member->Socio}}">Seleccionar</a>
									</div>
								</div>
							</div>
						@endif
						
						@if(str_contains($member->Parentesco,'Conyuge'))
							<div class="cloumn-five">
								<div class="intergrante-box">
									<div class="intergrante-img">
										@if($member->image_url=="")
											<img height="212" src="{{ asset('public/assests/images/avtar.jpg')}}"/>
										@else
											<img height="212" src="{{ $member->image_url }}"/>
										@endif
									</div>
									@php
										$dob=date('Y', strtotime($member->FechaNacimiento));
									    $diff = (date('Y') - $dob);
									@endphp
									<div class="intergrante-contnet">
										<h3>{{$member->Nombre}}</h3>
										<p>Número de socio: {{$member->Socio}}</p>
										<p>Edad:  {{$diff}} años</p>
										<p>Sexo: {{$member->Sexo}}</p>
										<a href="{{url('/course_selection')}}/{{$member->Socio}}">Seleccionar</a>
									</div>
								</div>
							</div>
						@endif

						@if($member->Parentesco=="" OR $member->Sexo=="")
							<div class="cloumn-five">
								<div class="intergrante-box">
									<div class="intergrante-img">
										@if($member->image_url=="")
											<img height="212" src="{{ asset('public/assests/images/avtar.jpg')}}"/>
										@else
											<img height="212" src="{{ $member->image_url }}"/>
										@endif
									</div>
									@php
										$dob=date('Y', strtotime($member->FechaNacimiento));
									    $diff = (date('Y') - $dob);
									@endphp
									<div class="intergrante-contnet">
										<h3>{{$member->Nombre}}</h3>
										<p>Número de socio: {{$member->Socio}}</p>
										<p>Edad:  {{$diff}} años</p>
										<p>Sexo: {{$member->Sexo}}</p>
										<a href="{{url('/course_selection')}}/{{$member->Socio}}">Seleccionar</a>
									</div>
								</div>
							</div>
						@endif
					@endforeach
				@endif

				@if($son_arr)
					@foreach($son_arr as $key=>$member)
						<div class="cloumn-five">
								<div class="intergrante-box">
									<div class="intergrante-img">
										@if($member->image_url=="")
											<img height="212" src="{{ asset('public/assests/images/avtar.jpg')}}"/>
										@else
											<img height="212" src="{{ $member->image_url }}"/>
										@endif
									</div>
									@php
										$dob=date('Y', strtotime($member->FechaNacimiento));
									    $diff = (date('Y') - $dob);
									@endphp
									<div class="intergrante-contnet">
										<h3>{{$member->Nombre}}</h3>
										<p>Número de socio: {{$member->Socio}}</p>
										<p>Edad:  {{$diff}} años</p>
										<p>Sexo: {{$member->Sexo}}</p>
										<a href="{{url('/course_selection')}}/{{$member->Socio}}">Seleccionar</a>
									</div>
								</div>
						</div>
					@endforeach
				@endif

				@if($daughter_arr)
					@foreach($daughter_arr as $key=>$member)
						<div class="cloumn-five">
								<div class="intergrante-box">
									<div class="intergrante-img">
										@if($member->image_url=="")
											<img height="212" src="{{ asset('public/assests/images/avtar.jpg')}}"/>
										@else
											<img height="212" src="{{ $member->image_url }}"/>
										@endif
									</div>
									@php
										$dob=date('Y', strtotime($member->FechaNacimiento));
									    $diff = (date('Y') - $dob);
									@endphp
									<div class="intergrante-contnet">
										<h3>{{$member->Nombre}}</h3>
										<p>Número de socio: {{$member->Socio}}</p>
										<p>Edad:  {{$diff}} años</p>
										<p>Sexo: {{$member->Sexo}}</p>
										<a href="{{url('/course_selection')}}/{{$member->Socio}}">Seleccionar</a>
									</div>
								</div>
						</div>
					@endforeach
				@endif

				@if($sobrino)
					@foreach($sobrino as $key=>$member)
						<div class="cloumn-five">
								<div class="intergrante-box">
									<div class="intergrante-img">
										@if($member->image_url=="")
											<img height="212" src="{{ asset('public/assests/images/avtar.jpg')}}"/>
										@else
											<img height="212" src="{{ $member->image_url }}"/>
										@endif
									</div>
									@php
										$dob=date('Y', strtotime($member->FechaNacimiento));
									    $diff = (date('Y') - $dob);
									@endphp
									<div class="intergrante-contnet">
										<h3>{{$member->Nombre}}</h3>
										<p>Número de socio: {{$member->Socio}}</p>
										<p>Edad:  {{$diff}} años</p>
										<p>Sexo: {{$member->Sexo}}</p>
										<a href="{{url('/course_selection')}}/{{$member->Socio}}">Seleccionar</a>
									</div>
								</div>
						</div>
					@endforeach
				@endif

				

				<div class="cloumn-five" style="display: none;">
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
				<div class="cloumn-five" style="display: none;">
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
				<div class="cloumn-five" style="display: none;">
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
				<div class="cloumn-five" style="display: none;">
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
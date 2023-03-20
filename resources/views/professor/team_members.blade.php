@extends('professor.layouts.group_list')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>APROBAR INTEGRANTES</h2>
		</div>
	</div>
	@if (Session::has('cart_message'))
		<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
		@php Session::forget('cart_message'); @endphp
	@endif
	<div class="intergrante-main">
		<div class="container">
			<div class="row">

				@if($members)
					@foreach($members as $member)
						<div class="cloumn-five">
							<div class="intergrante-box">
								<div class="intergrante-img">
									@if(@$member->image_url=="")
										<img  src="{{ asset('public/assests/images/avtar.jpg')}}"/>
									@else
										<img  src="{{ @$member->image_url }}"/>
									@endif
								</div>
								<div class="intergrante-contnet">
									<h3>Nombre : {{$member->nombre}}</h3>
									<p>Socio : {{$member->socio}}</p>
									<p>Estatus : {{$member->estatus}}</p>
									<a href="">APROBAR</a>
									<a href="" style="background-color:#FF140B">RECHAZAR</a>
								</div>
							</div>
						</div>
					@endforeach
				@endif	

			</div>
		</div>
	</div> 
@stop
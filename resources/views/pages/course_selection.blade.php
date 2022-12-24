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
							<p>Socio seleccionado: <strong>{{$member_info->Nombre}}</strong></p>
							<a class="hgh-color" href="{{url('/')}}/my_account">Cambiar</a>
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
				@foreach($result as $key=>$row)

					@php $image_name = ''; @endphp
					@foreach($row as $index=>$item)
						@if($item->CategoriaImagen!='')
							@php 
								$image_name = $item->CategoriaImagen;
								break;
							@endphp
						@endif
					@endforeach

					<div class="col-md-3 col-6">
						<div class="socio-box">
							<div class="socio-img">
								
								@php 
									$url = '';
									if($image_name){
										$url = Helper::get_image_course($item->CategoriaImagen); 
									}
								@endphp

								@if($url)
									<img src="{{ $url }}"/>
								@else
									<img src="{{ asset('public/assests/images/bg.jpg')}}"/>
								@endif
							</div>
							<div class="socio-contnet">
								<h3>{{$key}}</h3>
								<a href="{{url('/course_selection_part')}}/{{$member_info->Socio}}/{{$key}}">Seleccionar</a>
							</div>
						</div>
					</div>
				@endforeach
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
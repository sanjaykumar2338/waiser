@extends('layouts.homepage')
@section('content')

	@if (Session::has('cart_message'))
		<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
		@php Session::forget('cart_message'); @endphp
	@endif
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>{{$product->Descripcion}}</h2>
		</div>
	</div>
	<div class="prd-main">
		<div class="cl-tp">
			<div class="container">
				<p>Socio seleccionado: <strong>{{$member_info->Nombre}}</strong></p>
			</div>
		</div>
		@if (Session::has('cart_message'))
   			<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
   			@php Session::forget('cart_message'); @endphp
		@endif
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="product-img">
						@php 
							$url = '';
							if($product->SubCategoriaImagen){
								$url = Helper::get_image_course($product->SubCategoriaImagen.'.jpg'); 
							}
						@endphp

						@if($url)
							<img src="{{ $url }}"/>
						@else
							<img src="{{ asset('public/assests/images/product-1.jpg')}}"/>
						@endif
						<a class="cart-btn red-btn hide-mb" onclick="history.back()">Regresar y elegir otro</a>
					</div>
				</div>
				<div class="col-md-7">
					<div class="product-detail">
						<div class="d-flex flex-wrap align-items-center justify-content-between prd-prc">
							<h3>Precio: ${{number_format($product->Precio, 2)}}</h3>
							<p class="lugares"><span></span>{{$product->Disponible}} LUGARES DISPONIBLES DE {{$product->Cupo}}</p>
						</div>
						<ul>
							<li>HORARIO:<strong>{{$product->Horario}} {{$product->Lunes}} {{$product->Martes}} {{$product->Miercoles}} {{$product->Jueves}} {{$product->Viernes}} {{$product->Sabado}} {{$product->Domingo}}</strong></li>
							<li>ciclo:<strong>{{$product->Ciclo}}</strong></li>
							<li>COORDINACIÓN:<strong>{{$product->Coordinacion}}</strong></li>
							<li>inicio del curso:<strong>{{date('d/m/Y',strtotime($product->Inicio))}}</strong></li>
							<li>fin del curso:<strong>{{date('d/m/Y',strtotime($product->Fin))}}</strong></li>
							<li>sede:<strong>{{$product->SEDE}}</strong></li>
							<li>ESPACIO:<strong>{{$product->Espacio}}</strong></li>
							<li>profesor:<strong>{{$product->NombreproProf}}</strong></li>
							<li>género:<strong>{{$product->CDISexo}}</strong></li>
							<li>edad mínima:<strong>{{$product->CDIEdadMinimam}}</strong></li>
							<li>edad máxima:<strong>{{$product->CDIEdadMaxima}}</strong></li>
							<li>nivel:<strong>{{$product->Nivel}}</strong></li>
							<li>requiere cobertura médica:<strong>{{$product->RequiereCoberturaMedica}}</strong></li>
							<li>PAQUETE:<strong>{{$product->Paquete}}</strong></li>
						</ul>

						@if($product->Disponible==0)
						<a class="cart-btn blue-btn" style="background-color: red;" href="javascript:void(0)">Curso agotado</a>
						@else
						<a class="cart-btn blue-btn" href="{{url('add_to_cart_detail')}}/{{$station}}/{{$package}}/{{$member_info->Socio}}/{{$coordinacion}}/{{$product_data}}">Agregar al carrito</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
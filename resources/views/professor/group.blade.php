@extends('professor.layouts.group_list')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>SELECCIONAR EQUIPO REPRESENTATIVO</h2>
		</div>
	</div>
	@if (Session::has('cart_message'))
		<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
		@php Session::forget('cart_message'); @endphp
	@endif
	<div class="intergrante-main">
		<div class="container">
			<div class="row">				

				@if($group)
					@foreach($group as $item)
						<div class="col-lg-4 col-md-6 col-sm-12 ">
							<div class="intergrante-box">
								<div class="intergrante-contnet">
									<h3 class="text-center" style="font-size:17px;"><?php echo $item->Descripcion; ?> <?php echo date('Y', strtotime($item->FechaInicio)) ?>-<?php echo date('Y', strtotime($item->FechaFin)) ?></h3>
									<a href="{{url('/profesores/team/')}}/<?php echo $item->Profesor ?>/<?php echo $item->PaqueteNo ?>" class="btn-1">SELECCIONAR</a>
								</div>
							</div>
						</div>
					@endforeach
				@else
					No record found
				@endif
							
			</div>
		</div>
	</div>
@stop
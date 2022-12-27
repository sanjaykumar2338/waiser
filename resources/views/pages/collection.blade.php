@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Selecciona el curso (Día, Horario, Maestro, Sede etc.) </h2>
		</div>
	</div>
	<div class="collection-main">
		<div class="cl-tp">
			<div class="container">
				<p>Socio seleccionado: <strong>{{$current_member->Nombre}}</strong></p>
			</div>
		</div>

		@if (Session::has('cart_message'))
   			<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
   			@php Session::forget('cart_message'); @endphp
		@endif

		<div class="collection-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="cl-left-side">
							<h3 class="cl-title">{{$coordinacion}} <a href="{{url('/')}}/my_account" class="brd-color">Cambiar</a></h3>
							
							<form name="filter_frm" method="GET" action="{{URL('/course_selection_part')}}/{{$current_member->Socio}}/{{$coordinacion}}" class="filter_frm">	

							<div class="filter-side">
								<h4>FILTRAR POR:</h4>
								<div class="dias-bx">
									<h5>DÍAS</h5>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Lunes" id="customCheck1" @php echo ($dias_param && in_array('Lunes',$dias_param)) ? 'checked':'' @endphp>
										<label class="custom-control-label" for="customCheck1">Lunes</label>
									</div>
									<div class="custom-control custom-checkbox">	
										<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Martes" id="customCheck2" @php echo ($dias_param && in_array('Martes',$dias_param)) ? 'checked':'' @endphp>
										<label class="custom-control-label" for="customCheck2">Martes</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Miercoles" id="customCheck3" @php echo ($dias_param && in_array('Miercoles', $dias_param)) ? 'checked':'' @endphp>
										<label class="custom-control-label" for="customCheck3">Miercoles</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Jueves" id="customCheck4" @php echo ($dias_param && in_array('Jueves', $dias_param)) ? 'checked':'' @endphp>
										<label class="custom-control-label" for="customCheck4">Jueves</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Viernes" id="customCheck5" @php echo ($dias_param && in_array('Viernes', $dias_param)) ? 'checked':'' @endphp>
										<label class="custom-control-label" for="customCheck5">Viernes</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Sabado" id="customCheck6" @php echo ($dias_param && in_array('Sabado',$dias_param)) ? 'checked':'' @endphp>
										<label class="custom-control-label" for="customCheck6">Sabado</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Domingo" id="customCheck7" @php echo ($dias_param && in_array('Domingo', $dias_param)) ? 'checked':'' @endphp>
										<label class="custom-control-label" for="customCheck7">Domingo</label>
									</div>
								</div>

								@if($sede)
									<div class="dias-bx">
										<h5>SEDE</h5>
										@foreach($sede as $key=>$row)
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input sede_filter" name="sede[]" value="{{$row}}" id="customCheck{{$key+8}}" @php echo (request()->get('sede') && in_array($row, request()->get('sede'))) ? 'checked':'' @endphp>
												<label class="custom-control-label" for="customCheck{{$key+8}}">{{$row}}</label>
											</div>
										@endforeach
									</div>
								@endif

							</form>
							</div>
						</div>
					</div>
					
					<div class="col-lg-8">
						<div class="row">
						@if($result)
							@foreach($result as $row)
								<div class="col-md-4">
									<div class="cl-pd-box">
										<div class="cl-pd-img">											
											@php 
												$url = '';
												if($row->SubCategoriaImagen){
													$url = Helper::get_image_course($row->SubCategoriaImagen.'.jpg'); 
												}

												$product_info = urlencode(serialize($row));
											@endphp

											@if($url)
												<a href="{{url('product')}}/{{$product_info}}/{{$row->Estacion}}/{{$row->Paquete}}/{{$current_member->Socio}}/{{$coordinacion}}"><img src="{{ $url }}"/></a>
											@else
												<a href="{{url('product')}}/{{$product_info}}/{{$row->Estacion}}/{{$row->Paquete}}/{{$current_member->Socio}}/{{$coordinacion}}"><img src="{{ asset('public/assests/images/cl-prd.jpg')}}"/></a>
											@endif
										</div>
										<div class="cl-pd-ct prd-content">
											<div style="min-height: 290px;">
												<h2 class="brd-color">{{$row->Descripcion}}</h2>
												<h2>Precio:  ${{number_format($row->Precio, 2)}}</h2>
												<ul class="prd-tm d-flex flex-wrap">
													<li>{{$row->Lunes}} {{$row->Martes}} {{$row->Miercoles}} {{$row->Jueves}} {{$row->Viernes}} {{$row->Sabado}} {{$row->Domingo}}</li>  
													<li>{{$row->Horario}}  </li> 
												</ul>
												<p>Inicia: {{date('d-m-Y',strtotime($row->Inicio))}}   Finaliza: {{date('d-m-Y',strtotime($row->Fin))}}  </p>
												<div class="pr-color">
													<p>Sede:  {{$row->SEDE}}    </p>
													<p>Profesor:  {{$row->NombreproProf}}</p>
												</div>
												<h3>{{$row->Disponible}} lugares disponibles de {{$row->Cupo}}</h3>
											</div>
											<a classs="add_to_cart" href="{{url('add_to_cart')}}/{{$row->Estacion}}/{{$row->Paquete}}/{{$current_member->Socio}}/{{$coordinacion}}/{{$product_info}}">Agregar al carrito</a>
										</div>
									</div>
								</div>
							@endforeach
						@else
							ningún record fue encontrado !
						@endif
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

	<script type="text/javascript">
		$(function(){
		  	$('.dias_filter, .sede_filter').on('change',function(){
		  	$('.filter_frm').submit();
		  });
		});
	</script>
@stop
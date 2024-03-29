@extends('layouts.homepage')
@section('content')
	
<style type="text/css">
	body {
	    margin: 0px;
	    font-family: 'Hind', sans-serif !important;
	}
	.custom-chk-btn {
	    margin: 4px;
	    display: inline-block;
	    line-height: normal;
	}
	.custom-chk-btn label {
	  line-height: normal;
	  width: auto;
	  height: auto;
	  display: inline-block;
	  margin: 0 !important;
	  border-radius: 50px !important;
	  overflow: hidden;
	}

	.custom-chk-btn label span {
	  text-align: center;
	  padding: 3px 0;
	  display: block;
	}

	.custom-chk-btn label input {
	  position: absolute;
	  display: none;
	  color: #fff !important;
	}
	.custom-chk-btn label input + span {
	    color: #000;
	    padding: 8px 20px 7px;
	    border-radius: 50px !important;
	    border: 1px solid #000;
	    font-weight: 400;
	    cursor: pointer;
	    display: inline-block;
	    line-height: normal;
	}
	.custom-chk-btn input:checked + span {
	    color: #ffffff;
	}
	.custom-chk-btn input:checked + span{background-color: #01539E;border-color:#01539E;}
</style>

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
							<h3 class="cl-title">{{$coordinacion}} <a href="{{url('/course_selection')}}/{{$current_member->Socio}}" class="brd-color">Cambiar</a> <img src="{{ asset('public/assests/images/fitler.png')}}" style="cursor:pointer;float: right;" width="46" height="42" class="mobile_filter"></h3>
							

							<form name="filter_frm" method="GET" action="{{URL('/course_selection_part')}}/{{$current_member->Socio}}/{{$coordinacion}}" class="filter_frm desktop_filter">	

							<div class="filter-side">
								<h4>FILTRAR POR:</h4>
								<div class="dias-bx">
									<h5>DÍAS</h5>
									<div class="custom-chk-btn">
										<label>
											<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Lunes" id="customCheck1" @php echo ($dias_param && in_array('Lunes',$dias_param)) ? 'checked':'' @endphp>
											<span>Lunes</span>
										</label>
									</div><br>
									<div class="custom-chk-btn">
										<label>
											<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Martes" id="customCheck2" @php echo ($dias_param && in_array('Martes',$dias_param)) ? 'checked':'' @endphp>
											<span>Martes</span>
										</label>
									</div><br>
									<div class="custom-chk-btn">
										<label>
											<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Miercoles" id="customCheck3" @php echo ($dias_param && in_array('Miercoles', $dias_param)) ? 'checked':'' @endphp>
											<span>Miercoles</span>
										</label>
									</div><br>
									<div class="custom-chk-btn">
										<label>
											<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Jueves" id="customCheck4" @php echo ($dias_param && in_array('Jueves', $dias_param)) ? 'checked':'' @endphp>
											<span>Jueves</span>
										</label>
									</div><br>
									<div class="custom-chk-btn">
										<label>
											<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Viernes" id="customCheck5" @php echo ($dias_param && in_array('Viernes', $dias_param)) ? 'checked':'' @endphp>
											<span>Viernes</span>
										</label>
									</div><br>
									<div class="custom-chk-btn">
										<label>
											<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Sabado" id="customCheck6" @php echo ($dias_param && in_array('Sabado',$dias_param)) ? 'checked':'' @endphp>
											<span>Sabado</span>
										</label>
									</div><br>
									<div class="custom-chk-btn">
										<label>
											<input type="checkbox" class="custom-control-input dias_filter" name="dias[]" value="Domingo" id="customCheck7" @php echo ($dias_param && in_array('Domingo', $dias_param)) ? 'checked':'' @endphp>
											<span>Domingo</span>
										</label>
									</div><br>
								</div>

								@if($sede)
									<div class="dias-bx">
										<h5>SEDE</h5>
										@foreach($sede as $key=>$row)
											<div class="custom-chk-btn">
												<label>
													<input type="checkbox" class="custom-control-input sede_filter" name="sede[]" value="{{$row}}" id="customCheck{{$key+8}}" @php echo (request()->get('sede') && in_array($row, request()->get('sede'))) ? 'checked':'' @endphp>
													<span for="customCheck{{$key+8}}">{{$row}}</span>
												</label>
											</div><br>
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
											<div style="min-height: 250px;">
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
											@if($row->Disponible==0)
											<a style="background-color: red;" classs="add_to_cart" href="javascript:void(0)">Curso agotado</a>
											@else
											<a classs="add_to_cart" href="{{url('add_to_cart')}}/{{$row->Estacion}}/{{$row->Paquete}}/{{$current_member->Socio}}/{{$coordinacion}}/{{$product_info}}">Agregar al carrito</a>
											@endif
										</div>
									</div>
								</div>
							@endforeach
						@else
							No hay resultados en base a tu selección.
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

		  	$('.mobile_filter').on('click',function(){
		  		$(".filter_frm").toggle();
	  		});
		});
	</script>
@stop
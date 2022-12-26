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
							<div class="filter-side">
								<h4>FILTRAR POR:</h4>
								<div class="dias-bx">
									<h5>DÍAS</h5>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
										<label class="custom-control-label" for="customCheck1">Lunes</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
										<label class="custom-control-label" for="customCheck2">Martes</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
										<label class="custom-control-label" for="customCheck2">Miercoles</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
										<label class="custom-control-label" for="customCheck2">Jueves</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
										<label class="custom-control-label" for="customCheck2">Viernes</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
										<label class="custom-control-label" for="customCheck2">Sabado</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
										<label class="custom-control-label" for="customCheck2">Domingo</label>
									</div>
								</div>
								<div class="dias-bx">
									<h5>SEDE</h5>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck3" checked="">
										<label class="custom-control-label" for="customCheck3">CDI</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck4" checked="">
										<label class="custom-control-label" for="customCheck4">PUNTO CDI</label>
									</div>
								</div>
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
											<a classs="add_to_cart" href="{{url('add_to_cart')}}/{{$row->Estacion}}/{{$row->Paquete}}/{{$current_member->Socio}}/{{$coordinacion}}/{{$product_info}}">Agregar al carrito</a>
										</div>
									</div>
								</div>
							@endforeach
						@endif

							<div class="col-md-4" style="display:none;">
								<div class="cl-pd-box">
									<div class="cl-pd-img">
										<img src="{{ asset('public/assests/images/cl-prd.jpg')}}"/>
									</div>
									<div class="cl-pd-ct prd-content">
										<h2 class="brd-color">Descricpión del curso 2</h2>
										<h2>Precio:  $4,340</h2>
										<ul class="prd-tm d-flex flex-wrap">
											<li>Lunes y Míercoles </li>  
											<li>16:40 a 15:40  </li> 
										</ul>
										<p>Inicia: 10/01/2022   Finaliza: 10/06/2022  </p>
										<div class="pr-color">
											<p>Sede:  CDI    </p>
											<p>Profesor:  Adrián Olvera</p>
										</div>
										<h3>8 lugares disponibles de 10</h3>
										<a href="#">Agregar al carrito</a>
									</div>
								</div>
							</div>
							<div class="col-md-4" style="display:none;">
								<div class="cl-pd-box">
									<div class="cl-pd-img">
										<img src="{{ asset('public/assests/images/cl-prd.jpg')}}"/>
									</div>
									<div class="cl-pd-ct prd-content">
										<h2 class="brd-color">Descricpión del curso 3</h2>
										<h2>Precio:  $4,340</h2>
										<ul class="prd-tm d-flex flex-wrap">
											<li>Lunes y Míercoles </li>  
											<li>16:40 a 15:40  </li> 
										</ul>
										<p>Inicia: 10/01/2022   Finaliza: 10/06/2022  </p>
										<div class="pr-color">
											<p>Sede:  CDI    </p>
											<p>Profesor:  Adrián Olvera</p>
										</div>
										<h3>8 lugares disponibles de 10</h3>
										<a href="#">Agregar al carrito</a>
									</div>
								</div>
							</div>
							<div class="col-md-4" style="display:none;">
								<div class="cl-pd-box">
									<div class="cl-pd-img">
										<img src="{{ asset('public/assests/images/cl-prd.jpg')}}"/>
									</div>
									<div class="cl-pd-ct prd-content">
										<h2 class="brd-color">Descricpión del curso 4</h2>
										<h2>Precio:  $4,340</h2>
										<ul class="prd-tm d-flex flex-wrap">
											<li>Lunes y Míercoles </li>  
											<li>16:40 a 15:40  </li> 
										</ul>
										<p>Inicia: 10/01/2022   Finaliza: 10/06/2022  </p>
										<div class="pr-color">
											<p>Sede:  CDI    </p>
											<p>Profesor:  Adrián Olvera</p>
										</div>
										<h3>8 lugares disponibles de 10</h3>
										<a href="#">Agregar al carrito</a>
									</div>
								</div>
							</div>
							<div class="col-md-4" style="display:none;">
								<div class="cl-pd-box">
									<div class="cl-pd-img">
										<img src="{{ asset('public/assests/images/cl-prd.jpg')}}"/>
									</div>
									<div class="cl-pd-ct prd-content">
										<h2 class="brd-color">Descricpión del curso 5</h2>
										<h2>Precio:  $4,340</h2>
										<ul class="prd-tm d-flex flex-wrap">
											<li>Lunes y Míercoles </li>  
											<li>16:40 a 15:40  </li> 
										</ul>
										<p>Inicia: 10/01/2022   Finaliza: 10/06/2022  </p>
										<div class="pr-color">
											<p>Sede:  CDI    </p>
											<p>Profesor:  Adrián Olvera</p>
										</div>
										<h3>8 lugares disponibles de 10</h3>
										<a href="#">Agregar al carrito</a>
									</div>
								</div>
							</div>
							<div class="col-md-4" style="display:none;">
								<div class="cl-pd-box">
									<div class="cl-pd-img">
										<img src="{{ asset('public/assests/images/cl-prd.jpg')}}"/>
										<div class="cl-overlay">
											<p>Curso Agotado</p>
										</div>
									</div>
									<div class="cl-pd-ct prd-content">
										<h2 class="brd-color">Descricpión del curso 6</h2>
										<h2>Precio:  $4,340</h2>
										<ul class="prd-tm d-flex flex-wrap">
											<li>Lunes y Míercoles </li>  
											<li>16:40 a 15:40  </li> 
										</ul>
										<p>Inicia: 10/01/2022   Finaliza: 10/06/2022  </p>
										<div class="pr-color">
											<p>Sede:  CDI    </p>
											<p>Profesor:  Adrián Olvera</p>
										</div>
										<h3>8 lugares disponibles de 10</h3>
									</div>
								</div>
							</div>
							
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
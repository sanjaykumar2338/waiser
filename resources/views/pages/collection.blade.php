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
				<p>Socio seleccionado: <strong>Nombre Apellido Apellido</strong></p>
			</div>
		</div>
		
		<div class="collection-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="cl-left-side">
							<h3 class="cl-title">Futbol Soccer <span class="brd-color">Cambiar</span></h3>
							<div class="filter-side">
								<h4>FILTRAR POR:</h4>
								<div class="dias-bx">
									<h5>DÍAS</h5>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
										<label class="custom-control-label" for="customCheck1">LUNES Y MIÉRCOLES</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
										<label class="custom-control-label" for="customCheck2">MARTES Y JUEVES</label>
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
							<div class="col-md-4">
								<div class="cl-pd-box">
									<div class="cl-pd-img">
										<img src="{{ asset('public/assests/images/cl-prd.jpg')}}"/>
									</div>
									<div class="cl-pd-ct prd-content">
										<h2 class="brd-color">Descricpión del curso 1</h2>
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
							<div class="col-md-4">
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
							<div class="col-md-4">
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
							<div class="col-md-4">
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
							<div class="col-md-4">
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
							<div class="col-md-4">
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
@stop
@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Selecciona el deporte o actividad</h2>
		</div>
	</div>
	@if (Session::has('cart_message'))
		<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
		@php Session::forget('cart_message'); @endphp
	@endif
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
									<input type="text" id="filter" placeholder="BUSCAR"/>
									<button><img src="{{ asset('public/assests/images/Search_light.svg')}}"></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row filter_results">
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

					<div class="col-md-3 col-6 main_box">
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

	<script type="text/javascript">
	$("#filter").keyup(function() {

      // Retrieve the input field text and reset the count to zero
      var filter = $(this).val(),
        count = 0;

      // Loop through the comment list
      $('.filter_results .main_box').each(function() {


        // If the list item does not contain the text phrase fade it out
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
          $(this).hide();  // MY CHANGE

          // Show the list item if the phrase matches and increase the count by 1
        } else {
          $(this).show(); // MY CHANGE
          count++;
        }

      });
    });
	</script>
@stop
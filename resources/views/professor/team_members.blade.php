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
						@if($member->PaqueteNo==$paquete_no)
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
										<p>Estatus : <span class="current_status_{{$member->socio}}">{{$member->estatus}}</span></p>
										<a href="#" class="change_status" data-action="Aprobado" data-socio="{{$member->socio}}" data-paqueteno="{{$member->PaqueteNo}}">APROBAR</a>
										<a href="#" class="change_status" data-action="Rechazado" data-socio="{{$member->socio}}" data-paqueteno="{{$member->PaqueteNo}}" style="background-color:#FF140B">RECHAZAR</a>
									</div>
								</div>
							</div>
						@endif
					@endforeach
				@endif	

			</div>
		</div>
	</div> 

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.change_status').click(function(e){
				e.preventDefault();
				let token = $('meta[name=csrf-token]').attr('content');
				let socio = $(this).attr('data-socio');
				let paqueteno = $(this).attr('data-paqueteno');
				let action = $(this).attr('data-action');

				$.post({
		          url: "{{ url('/') }}/profesores/change_status",
		          data: {'socio': socio, '_token': token, 'paqueteno':paqueteno, 'action':action}, 
		          dataType: 'json',
		          success: function (response) {
		            //console.log(response.status);
		            if(response.status){
		            	$('.current_status_'+socio).text(action)
		            }

		            alert(response.message);
		          },
		          error: function (response) {
		            alert(response);
		          },
		        });
	        });
		});
	</script>
@stop
@extends('layouts.homepage')
@section('content')
	<div class="cmn-hero" style='background-image: url("{{ asset('public/assests/images/hero-banner.jpg')}}"'>
		<div class="container">
			<h2>Checkout</h2>
		</div>
	</div>

	@if (Session::has('cart_message'))
		<div class="alert alert-info">{{ Session::get('cart_message') }}</div>
		@php Session::forget('cart_message'); @endphp
	@endif

	<div class="carrito">
		<div class="container">
			<div class="row hide-mb">
				<div class="col-md-12">
					<h2 class="title">Carrito</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9 col-8">
					<h4 class="pd-sm-title">CURSO</h4>
				</div>
				<div class="col-md-3 col-4">
					<h4 class="pd-sm-title">PRECIO</h4>
				</div>
			</div>
			<div class="crt-rep">

			@php
				$cart = session()->get('cart', []);
				//echo "<pre>"; print_r($cart); die;
				$total = 0.00;
			@endphp	

			@if($cart && request()->session()->has('cart'))
					@foreach($cart as $key=>$row)
					  @php
					  	//echo "<pre>"; print_r($cart); die;
					  	$total += $row['product_price'];
					  @endphp
					<div class="row align-items-center">
						<div class="col-md-9 col-8">
							<div class="prd-crt">
								<div class="d-flex flex-wrap prd-inner">
									<div class="prd-img">
									@php 
										$url = '';
										if($row['product_image']){
											$url = Helper::get_image_course($row['product_image'].'.jpg'); 
										}
									@endphp

									@if($url)
										<img width="184" height="127" src="{{ $url }}"/>
									@else
										<img src="{{ asset('public/assests/images/prd-1.jpg')}}"/>
									@endif
									</div> 
									<div class="prd-content">
										<h2 class="brd-color">{{$row['product_name']}}</h2>
										<h2>{{$row['member_name']}} </h2>
										<span class="prd-tm">{{$row['product_time']}} {{$row['product_days']}} </span>
										<p>Inicia: @if(isset($row['inicio'])) {{date('d/m/Y',strtotime(@$row['inicio']))}}@endif   Finaliza: @if(isset($row['fin'])){{date('d/m/Y',strtotime(@$row['fin']))}}@endif   </p>
										<p>Sede:  {{$row['product_sede']}}     </p>
										<p>Profesor:  {{$row['product_professor']}}</p>
									</div> 
								</div> 
							</div> 
						</div> 
						<div class="col-md-3 col-4">
							<div class="prd-right">
								<div class="d-flex justify-content-between align-items-center">
									<div class="prd-price">
										<h3>${{number_format($row['product_price'], 2)}}</h3>
									</div>
									<div class="prd-cross">
										<a class="prd-dlt" style="cursor: pointer;" href="{{url('/remove_cart')}}/{{$key}}"><img src="{{ asset('public/assests/images/delete.svg')}}"></a>
									</div>
								</div> 
							</div> 
						</div> 
					</div>
				@endforeach	
			@else
				<h3>El carrito esta vacío</h3>
			@endif 
			
			</div> 
		</div> 
	</div> 

	@if($cart && request()->session()->has('cart'))
	<div class="carrito-cupn">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-7">
					<div class="cupon">
						<h3>CUPONES</h3>
						<form>
							<div class="coupon-field">
								<input type="text" id="coupon_value" placeholder="Ingresar cupón"/>
								<button id="coupon_apply">Agregar</button>
								<span style="color: cadetblue;font-weight: 800;" id="coupon_message"></span>
							</div>
						</form>
					</div>
				</div>

				@php $deportiva = 0; $total_insurance_price = 0; @endphp
				@foreach($cart as $key=>$row)
					@php
						$deportiva +=1;
						$total_insurance_price += $row['insurance_price'];
					@endphp
				@endforeach

				<div class="col-md-5">
					<div class="subtotal">
						<table>
							<tr>
								<td>Subtotal</td>
								<td><strong>${{number_format($total, 2)}}</strong></td>
							</tr>

							@if($total_insurance_price)
							<tr>
								<td>Cobertura </br>deportiva x {{$deportiva}}</td>
								<td><strong>${{number_format($total_insurance_price, 2)}}</strong></td>
							</tr>
							@endif

							@if($coupon_discount)
							<tr>
								<td>Descuentos</td>
								<td><strong>-${{number_format($coupon_discount, 2)}}</strong></td>
							</tr>
							@endif
							<tr>
								<td>Total </td>
								<td><strong>${{number_format($total + $total_insurance_price - $coupon_discount, 2)}}</strong></td>
							</tr>
						</table>
					</div>
				</div>

				@if($coupon_discount)
					@php 
						$coupons = session()->get('coupons',[]); 
					@endphp
					<div class="col-md-5">
						Coupon:
						<div class="subtotal">
							<table>
								@if($coupons)
									@foreach($coupons as $coupon)
										<tr>
											<td>{{$coupon['coupon_name']}}</td>
											<td><a class="prd-dlt" style="cursor: pointer;" href="{{url('/coupon/remove')}}/{{$coupon['coupon_id']}}"><img src="{{asset('public/assests/images/delete.svg')}}"></a></td>
										</tr>
									@endforeach
								@endif
							</table>
						</div>

						<br/><br/>
					</div>
				@endif
			</div>
		</div>
	</div>
	
	<!-- <div class="carrito-info hide-mb"> -->
	<div class="carrito-info">
		<form method="POST" name="payment_frm" id="payment_frm" action="{{url('submit_payment')}}">
			@csrf
			<input type="hidden" name="payment_type" value="" id="payment_type">
			<div class="container">
				<div class="carrito-chck">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="customCheck1" required="">
						<label class="custom-control-label" for="customCheck1">Acepto los términos y condiciones de  los cursos.  <a href="{{url('/terms_condition')}}" target="_blank">Ver</a></label>
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="customCheck2" required="">
						<label class="custom-control-label" for="customCheck2">Acepto los reglamentos de los cursos.  <a href="{{url('/regulations')}}" target="_blank">Ver</a></label>
					</div>
				</div>
				<div class="reserva-bx">
					<h3>Reserva y paga después </h3>
					<p>El lugar se reserva por 48 horas. Se puede pagar en las cajas del Depor o por medio esta página en la sección de Mis inscripciones.</p>
					<button class="payment_button" value="pay_later" type="submit">Reservar y pagar después</button>
				</div>
				<div class="reserva-bx">
					<h3>Reserva y paga en linea ahora</h3>
					<p>Formas de pago.</p>
					<button class="payment_button" value="pay_online" type="submit">Reservar y pagar ahora en línea</button>
				</div>
			</div>
		</form>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script type="text/javascript">
		$('.payment_button').on('click', function(){
			$('#payment_type').val($(this).val());
		});

		$("form").submit(function(e){
	        e.preventDefault();
	        setTimeout(function(){
	        	$(this).unbind(e);
	        	$('#payment_frm').submit();
	        },300)
	    });

	    $('#coupon_apply').on('click', function(e){
	    	e.preventDefault();
	        let coupon_value = $('#coupon_value').val();
	        if(coupon_value!=""){

	        	coupon_value = coupon_value.trim();
	            CSRF_TOKEN = "{{ csrf_token() }}"
	            //$('#coupon_apply').prop('disabled', true);

	        	$.ajax({
                    url: "{{url('/apply_coupon')}}",
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, coupon:coupon_value},
                    dataType: 'JSON',
                    success: function (data) { 
                    	//$('#coupon_apply').prop('disabled', false);
                        $("#coupon_message").html(data.msg); 
                        $('#coupon_value').val('');
                        setTimeout(function(){
                        	$("#coupon_message").html(''); 
                        	if(data.status=='success'){
                        		window.location.reload();
                        	}
                        },2500);
                    }
                }); 
	        }
    	});
	</script>
	@endif
@stop
<div class="ftr-bg" style='background-image: url("{{ asset('public/assests/images/ftr-bg.jpg')}}")'>
</div>

<div class="modal fade cart-pop" id="myCart">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Carrito</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
			<div class="d-flex carrit-mm">
				<div class="car-left">
					<p class="cr-hgh">Carrito</p>
				</div>
				<div class="car-right">
					<p class="cr-hgh">PRECIO</p>
				</div>
			</div>
			<div class="carrit-pp" style="max-height: 400px;overflow-y: auto;">

				@php
					$cart = session()->get('cart', []);
					$total = 0.00;
				@endphp

				@if($cart)
					@foreach($cart as $key=>$row)
					  @php
					  	//echo "<pre>"; print_r($row); die;
					  	$total += $row['product_price'];
					  @endphp
						<div class="d-flex carrit-mm align-items-center">
							<div class="car-left d-flex">
								<div class="car-pd-img">
									@php 
												$url = '';
												if($row['product_image']){
													$url = Helper::get_image_course($row['product_image'].'.jpg'); 
												}
									@endphp

									@if($url)
										<img src="{{ $url }}"/>
									@else
										<img src="{{ asset('public/assests/images/cl-prd.jpg')}}"/>
									@endif
								</div>
								<div class="car-pd-content">
									<h3>{{$row['product_name']}}</h3>
									<h3>{{$row['member_name']}} </h3>
									<p>{{$row['product_days']}} {{$row['product_time']}}</p>
									<p>Sede:  {{$row['product_sede']}}    </p>
									<p>Profesor:  {{$row['product_professor']}}</p>
								</div>
							</div>
							<div class="car-right">
								<div class="car-prc d-flex justify-content-between align-items-center">
									<h4>${{number_format($row['product_price'], 2)}}</h4>
									<a style="cursor: pointer;" href="{{url('/remove_cart')}}/{{$key}}"><img src="{{ asset('public/assests/images/dlt-icon.png')}}"/></a>
								</div>
							</div>
						</div>
					@endforeach	
				@else
					<div class="d-flex carrit-mm align-items-center">
						<div class="car-left d-flex">							
							<div class="car-pd-content">
								<h3>El carrito esta vacío</h3>
							</div>
						</div>
					</div>
				@endif
			</div>
			@if($cart)
				<div class="car-total">
					<ul class="d-flex justify-content-end">
						<li>Total </li>
						<li>${{number_format($total, 2)}}</li>
					</ul>
					<div class="car-btn-grp">
						<a class="cart-btn" href="{{url('/checkout')}}">Checkout</a>
						<a class="cart-btn" href="{{url('/my_account')}}">Agregar otro curso</a>
					</div>
				</div>
			@endif
      </div>
      </div>
    </div>
</div>
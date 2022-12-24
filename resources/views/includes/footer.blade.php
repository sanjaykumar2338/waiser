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
			<div class="carrit-pp">

				@php
					$cart = session()->get('cart', []);
				@endphp

				@if($cart)
					@foreach($cart as $key=>$row)
						<div class="d-flex carrit-mm align-items-center">
							<div class="car-left d-flex">
								<div class="car-pd-img">
									<img src="{{ asset('public/assests/images/cl-prd.jpg')}}"/>
								</div>
								<div class="car-pd-content">
									<h3>Descricpión del curso 1</h3>
									<h3>Nombre Apellido1 Apellido2</h3>
									<p>Lunes y Míercoles 16:40 a 15:40  </p>
									<p>Sede:  CDI    </p>
									<p>Profesor:  Adrián Olvera</p>
								</div>
							</div>
							<div class="car-right">
								<div class="car-prc d-flex justify-content-between align-items-center">
									<h4>$4,340.00</h4>
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
			<div class="car-total">
				<ul class="d-flex justify-content-end">
					<li>Total </li>
					<li>$10,840.00</li>
				</ul>
				<div class="car-btn-grp">
					<a class="cart-btn" href="{{url('/checkout')}}">Checkout</a>
					<a class="cart-btn" href="#">Agregar otra curso</a>
				</div>
			</div>
        </div>
      </div>
    </div>
</div>
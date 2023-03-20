<div class="header">
	<div class="top-bar">
			<div class="container">
				@if(Session::has('user_id'))
				<ul class="d-flex flex-wrap align-itmes-center justify-content-end">
					<li style="display:none;"><a href="{{url('/')}}/my_account">MI CUENTA</a></li>
					<li><a href="{{url('/')}}/mi-cuenta">MI CUENTA</a></li>
					<li><a href="{{url('/')}}/logout">SALIR</a></li>
				</ul>
				@endif
			</div>
	</div>
</div>
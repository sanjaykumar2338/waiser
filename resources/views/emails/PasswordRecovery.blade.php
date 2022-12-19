<!DOCTYPE html>
<html>
<body>

<div>
	<img src="{{ asset('public/assests/images/logo.svg')}}" style="display:block;" data-auto-embed="attachment"/>&nbsp;&nbsp;&nbsp;<span style="color:blue;">Recuperacion de contrasena:</span>
</div>

<hr style="height:6px;border-width:0;color:gray;background-color:blue;">

Socio: {{$body['Socio']}}<br>

Contrasena: {{$body['Contrasena']}}<br>

Correo electronico: {{$body['Electronico']}}<br>

Nombre: {{$body['Nombre']}}<br>

</body>
</html>
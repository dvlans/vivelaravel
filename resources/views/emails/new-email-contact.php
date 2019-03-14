<!DOCTYPE html>
<html>
<head>
	<title>Nuevo correo</title>
</head>
<body>
	<p>Un cliente te ha enviado un correo</p>
	<p>Estos son los datos del cliente que realizó el correo:</p>
	<ul>
		<li>
			<strong>Nombre:</strong>
			{{ $name->name }}
		</li>
		<li>
			<strong>Email:</strong>
			{{ $email->email }}
		</li>
		<li>
			<strong>Mensaje:</strong>
			{{ $message->message }}
		</li>
	</ul>	
</body>
</html>
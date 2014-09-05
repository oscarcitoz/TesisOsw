<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Reinicio de Password</h2>

		<div>
			Para reiniciar tu Password, completa este formulario: {{ URL::to('password/reset', array($token)) }}.<br/>
			Este link expira dentro de {{ Config::get('auth.reminder.expire', 60) }} minutos.
		</div>
	</body>
</html>
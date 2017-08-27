<html lang="es">
	<head>
		<meta charset="ISO-8859-1">
		<meta http-equiv="cache-control" content="no-cache">
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.min.css">
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
		<script>
			function login(){ $('#login').dialog('open'); }
			
			$(function() {
				$('#login')
				.dialog({ width: 380, height: 280, modal: true, autoOpen: false,
					buttons: { 'Login': function(){ $(this).find('form').submit(); } }
				});
			});
		</script>
	</head>
	<body>
		<div id="login" title="Sign In">
			<form action="signin.htm" method="POST">
				<label>Usuario</label><br/>
				<input type="text" name="user" /><br/>
				<label>Clave</label><br />
				<input type="password" name="password" />
			</form>
		</div>
		<div id="wrapper">
			<h3>Bienvenido a la plataforma Mnc</h3>
			<p>Dentro de la plataforma encontraras herramientas para:
			<ul>
				<li>Imprimir Boletas</li>
				<li>Agendar Pacientes Manualmente</li>
				<li>Consultar Pacientes y estado en su Previsi&oacute;n</li>
				<li>Ingresar la Bitacora Diaria</li>
				<li>Informar una Incidencia</li>
			</ul>
			<p>
			Para poder hacer uso de dichas herramientas debes <a href="javascript:login()">Entrar al sitio</a>
			con las credenciales asociadas a tu sucursal.<br />
			En caso de no contar con ellas, favor de solicitarlas al Administrador.
			</p>
		</div>
	</body>
</html>

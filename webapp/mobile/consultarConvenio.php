<html>
	<head>
		<title>mini tools</title>
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
		<link rel="stylesheet" href="webapp/static/css/common.mobile.css">
		<link rel="stylesheet" href="webapp/static/css/menu.mobile.css">
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
		<script src="webapp/static/js/util.js"></script>
		<script>
			$(function(){
				$('#btnVolver').bind('click', function(event, ui){ location.href = 'paciente.htm'; });
			});
		</script>
	</head>
	<body>
		<div data-role="page" id="page" data-theme="b">
			<div data-role="header" id="header" align="center">
				<img src="webapp/static/img/mnc-logo.png" border="0" />
			</div>
			<div data-role="content">
				<label for="rut">Ingrese Rut del Paciente</label>
				<input type="text" id="rut" />
				<ul>
					<li><a data-rel="dialog" href="#wait" id="btnConsultarConvenio" data-role="button">Consulte Convenio </a></li>
				</ul>
			</div>
				<a href="#" id ="btnVolver" data-role="button">Volver</a>
		</div>
		<div data-role="page" id="wait">
			<div data-role="header"><h1>Aviso</h1></div>
			<div data-role="content"><p id="stdout" /></div>
		</div>
	</body>
</html>
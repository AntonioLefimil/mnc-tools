<html>
	<head>
		<title>mini tools</title>
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
		<link rel="stylesheet" href="webapp/static/css/common.mobile.css">
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
		<script type="text/javascript" src="webapp/static/js/menu.mobile.js"></script>
		<script>
			$(function(){
				inicializar();
		        $('#btnReiniciarKiosco').bind('click', function(event,ui){
					var $stdout = $('p#stdout');
		            $stdout.text('Cargando...');
					$.getJSON('rebootIE.htm')
					.fail(function(){ alert("Ocurrio un error en el servidor"); })
					.done(function(d){ $stdout.text('Ejecucion exitosa.'); });
		        });
			});
		</script>
	</head>
	<body>	
		<div data-role="page" id="page" data-theme="c">
			<div data-role="header" id="header" align="center" data-theme="c">
				<img src="webapp/static/img/mnc-logo.png" border="0" />
			</div>
			<div data-role="content">
				<ul id="menu">
					<li><a id="btnAgenPaciente" data-rel="dialog" href="#wait">Agendar Paciente Sonda</a></li>
					<li><a id="btnValidarPrevision">Validar Previsi&oacute;n</a></li>
					<li><a id="btnReiniciarKiosco" data-rel="dialog" href="#wait">Reiniciar Kiosko</a></li>
					<li><a id="btnEstadoTeclado">Mostrar Teclado</a></li>
					<li><a id="btnBoleta">Imprimir Boleta</a></li>
					<li><a id="btnBuscarAtencion" data-rel="dialog">Pago Manual</a></li>
					<li><a id="btnDevolver">Salir</a></li>
				</ul>
			</div>
		</div>
		<div data-role="dialog" id="wait">
			<div data-role="header"><h1>Aviso</h1></div>
			<div data-role="content"><p id="stdout" /></div>
		</div>
	</body>
</html>

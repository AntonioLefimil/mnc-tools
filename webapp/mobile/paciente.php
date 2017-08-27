<html>
	<head>
		<title>mini tools</title>
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0" />
		<link rel="stylesheet"href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
		<link rel="stylesheet" href="webapp/static/css/common.mobile.css">
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script	src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
		<script>
			$(function(){
				$('#btnMenu').bind('click', function(event, ui){ location.href = 'menu.htm'; });
				
				$('#btnConsultConvenio').bind('click', function(event,ui){ location.href = 'consultarConvenio.htm'; });
				$('#btnAgenPaciente').bind('click', function(event,ui){
					var out = $('#stdout');
					out.text('Cargando...');
					$.getJSON('contarPacientesSinAgendar.htm')
					.fail(function(){ out.text('Ocurrio un error en el servidor'); })
					.done(function(d){
						if (d.Count == 0){ out.text('No hay pacientes para agendar...'); }
						else { location.href = 'agendarPacienteHome.htm'; }
					});
				});
			});
		</script>	
	</head>
	
	<body>
		<div data-role="page" id="page" data-theme="b">
			<div data-role="header" id="header" align="center">
				<img src="webapp/static/img/mnc-logo.png" border="0">
			</div>
			<div data-role="content">
				<ul>
					<!-- <li><a id="btnConsultConvenio" data-role="button">Consultar Convenio</a></li> -->
				</ul>
			</div>
			
			<div data-role="footer" data-position="fixed">
				<ul>
					<li><a href="#" id="btnMenu" data-role="button" class="backButton">Menu</a></li>
				</ul>
			</div>
		</div>
		
		<div data-role="dialog" id="wait">
			<div data-role="header"><h1>Aviso</h1></div>
			<div data-role="content"><p id="stdout" /></div>
		</div>
		
	</body>
</html>
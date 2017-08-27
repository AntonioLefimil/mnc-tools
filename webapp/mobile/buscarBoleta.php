<html>
	<head>
		<title>mini tools</title>
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
		<link rel="stylesheet" href="webapp/static/css/common.mobile.css">
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
		<script src="webapp/static/js/util.js"></script>
		<script>
			$(function(){
				$('#fecha').val(util.now('yyyy-mm-dd'));
				$('#btnMenu').bind('click', function(event, ui){ location.href = 'menu.htm'; });
				$('#btnBuscar').bind('click', function(event, ui){
					var $stdout = $('p#stdout');
					var fecha = $('#fecha').val();
					var rut = $('#rut').val() || 0;
					$stdout.text('Cargando...');
					$.getJSON('contarBoletas.htm', {'rut': rut, 'fecha': fecha })
					.fail(function(){ $stdout.text('Ocurrio un error en el servidor'); })
					.done(function(d){
						if (d.count > 0){
							location.href= 'homeImprimirBoleta.htm?fecha='+fecha+'&rut='+rut;
						}
						else {
							$stdout.text('No hay resultados para la busqueda');
						}
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
			<div data-role="content" id="content" >
				<label for="date">Fecha de Atenci&oacute;n</label>
				<input type="date" id="fecha" />
				<label for="rut">Rut</label>
				<input type="text" id="rut" />
				<ul>
					<li><a id="btnBuscar" data-rel="dialog" href="#wait" data-role="button">Buscar</a></li>
				</ul>
			</div>
			<div data-role="footer" data-position="fixed">
				<ul>
					<li><a id="btnMenu" data-role="button" class="backButton">Menu</a></li>
				</ul>
			</div>
		</div>
		<div data-role="page" id="wait">
			<div data-role="header"><h1>Aviso</h1></div>
			<div data-role="content"><p id="stdout" /></div>
		</div>
	</body>
</html>
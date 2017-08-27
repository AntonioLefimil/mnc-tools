<html>
	<head>
		<title>mini tools</title>
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
		<link rel="stylesheet" href="webapp/static/css/common.mobile.css">
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
		<script src="webapp/static/js/util.js"></script>
		<script>
			function imprimirBoleta(){
				var boleta = $('input[name="rd"]:checked').val();
				var $stdout = $('p#stdout');
				if ( boleta ){
	                $stdout.text('Cargando...');
					$.getJSON('imprimirBoleta.htm', { 'boleta' : boleta })
					.done(function(d){ $stdout.text("Impresion Exitosa"); })
					.fail(function(){ $stdout.text("Hubo un problema Reintente"); });
				}
				else {
					$stdout.text("Seleccione una opcion");
				}
			}
			function buscarBoleta(){
				$.getJSON('buscarBoleta.htm')
				.fail(function(){ alert("Ocurrio un error en el servidor"); })
				.done(function(d){
					$('#Tabla').find('tbody tr').remove();
					for (var i in d){
						var row = $('<tr><td /><td /></tr>');
						row.find('td').eq(0).html('<input type="radio" name="rd" value="'+d[i].id+'" />');
						row.find('td').eq(1).text(d[i].paciente);
						row.appendTo($('#Tabla').find('tbody'));
					}
				});
					
			}
			
			$(function(){
				buscarBoleta();
				$('#btnVolver').bind('click', function(event, ui){ location.href = 'menu.htm'; });
				$('#btnImprimir').bind('click', function(event, ui){ imprimirBoleta(); });
			});
		</script>
	</head>
	<body>
		<div data-role="page" id="page" data-theme="c">
			<div data-role="header" id="header" align="center" data-theme="c">
				<img src="webapp/static/img/mnc-logo.png" border="0" />
			</div>
			<div data-role="content" align="center" class="ui-content" data-role="controlgroup" id="content">
				<table id="Tabla">
					<thead>
						<tr><td>Confirmar</td><td>Rut Paciente</td></tr>
					</thead>
					<tbody></tbody>
				</table>
				<ul>
					<li><a data-rel="dialog" href="#wait" id="btnImprimir" data-role="button" data-theme="b">Imprimir</a></li>
				</ul>
			</div>
			<div data-role="footer" data-theme="c" data-position="fixed">
				<ul>
					<li><a id="btnVolver" data-theme="b" data-role="button" class="backButton">Volver</a></li>
				</ul>
			</div>
		</div>
		<div data-role="page" id="wait">
			<div data-role="header"><h1>Aviso</h1></div>
			<div data-role="content"><p id="stdout" /></div>
		</div>
	</body>
</html>
<html>
	<head>
		<title>mini tools</title>
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0" />
		<link rel="stylesheet"href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
		<link rel="stylesheet" href="webapp/static/css/common.mobile.css">
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script	src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
		<script>
			function cargarDatos(){
				var params = location.href.split('?')[1];
				var id = params.split('&')[0].replace(/\D/g, '');
				$('#idConsulta').val(id);
				$.getJSON('obtenerDatosVentas.htm', { 'id': id })
				.fail(function(){ alert("Ocurrio un error en el servidor"); })
				.done(function(d){
					$('#txtNombrePaciente').val(d.nombre);
					$('#txtMonto').val(d.precio);
					$('#tipoAtencion').val(d.tipoAtencion);
				});
			}

			function confirmarPago(){
				var $sdtout = $('#stdout');
				$sdtout.text('Generando Boleta...');
				
				var codAut = $('#txtCodeAutorizacion').val();
				var idConsulta = $('#idConsulta').val();
				var tipoAtencion = $('#tipoAtencion').val();
				
				if (codAut.length == 0){
					$sdtout.text('Ingrese Codigo de Autorizacion');
					return;
				}
				
				$.getJSON('generarPago.htm', { 'idConsulta' : idConsulta, 'codAut': codAut, 'tipoAtencion': tipoAtencion })
				.fail(function(){ $sdtout.text('A ocurrido un error en el proceso, intente nuevamente.'); })
				.done(function(d){
					$sdtout.text('Imprimiendo Boleta...');
					$.getJSON('imprimirBoleta.htm', { 'boleta': idConsulta })
					.fail(function(){ $sdtout.text('A ocurrido un error al imprimir boleta'); })
					.done(function(d){  
						$sdtout.text('Agendando consulta...');
						$.getJSON('agendarPacienteMw.htm', { 'idConsulta' : idConsulta })
						.fail(function(){ $sdtout.text('Error al agendar paciente'); })
						.done(function(){ $sdtout.text('Agendado con exito'); })
						.always(function(){ setTimeout(function(){ location.href="menu.htm"; }, 2200); });
					});
				});
			}
			
			$(function(){
				cargarDatos();
				$('#btnVolver').bind('click', function(event, ui){ location.href = 'buscarAtencionPendiente.htm'; });
				$('#btnPagar').bind('click', function(event, ui){ confirmarPago(); });
				$('#txtCodeAutorizacion').blur(function(){ var self = $(this); self.val(self.val().replace(/\D/g,'')); });
			});
		</script>
	</head>
	<body>
		<div data-role="page" id="page" data-theme="c">
			<div data-role="header" id="header" align="center" data-theme="c">
				<img src="webapp/static/img/mnc-logo.png" border="0">
			</div>
			<div data-role="content">
				<input type="hidden" id="idConsulta" />
				<input type="hidden" id="tipoAtencion" />
				<label for="date">Nombre Paciente</label>
				<input type="text" id="txtNombrePaciente" readonly="readonly" />
				<label for="date">Monto</label>
				<input type="text" id="txtMonto" readonly="readonly"  />
				<!--  
				<label for="consulta">Forma de pago</label>
				<select id="cmbFormaDePago" data-theme="b" data-native-menu="false">
					<option value="1">Transbank Inalambrico</option>
					<option value="2">Transbank Kiosco</option>
				</select>
				-->
				<div id="toggle-content">
					<label id="lblCodAut" for="date">C&oacute;digo Autorizaci&oacute;n</label>
					<input type="number" id="txtCodeAutorizacion" />
				</div>
				<ul>
					<li><a id="btnPagar" data-role="button" data-theme="b" href="#wait" data-rel="dialog">Confirmar Pago</a></li>
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
			<div data-role="content"><h2 id="stdout"></h2></div>
		</div>
	</body>
</html>
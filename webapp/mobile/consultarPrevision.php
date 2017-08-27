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
			function cargarPrevisiones(){
				$.getJSON('getPreviones.htm')
				.fail(function(){ alert('A ocurrido un error en el servidor'); })
				.done(function(d){
					var $target = $('#cmbPrevision');
					for (var i in d){
						$('<option />').val(d[i].id).text(d[i].nombre).appendTo($target); 
					}
					$target.selectmenu('refresh');
				});
			}

			function validarPaciente(){
				var $out = $('#stdout').show();
				var $datos = $('#datos').hide();
				
				$out.text('Cargando...');
				
				try {
					var rut = $('#rutPaciente').val();
					var prevision = $('#cmbPrevision').val();
					
					if (rut.length == 0){ throw 'Ingrese Rut del Paciente'; }
					if (prevision == 0){ throw 'Seleccione Prevision'; }

					$.getJSON('validarPrevision.htm', { 'rut': rut, 'prevision': prevision })
					.fail(function(){ $out.text('A ocurrido un error interno en el servidor'); })
					.done(function(d){
						if (d.CodResult == 'F'){ $out.text(d.MsgResult); }
						else {
							$out.hide();
							$datos = $('#datos').show(); 
							$datos.find('#lblNombre').text('Nombre: ' + d.nombre);
							$datos.find('#lblPlan').text('Plan: ' + d.plan);
							$datos.find('#lblEstado').text('Estado: ' + d.estado);
						}
					});
				}
				catch(e){
					$out.text(e);
				}
			}
			
			$(function(){
				cargarPrevisiones();
				$('#btnVolver').bind('click', function(event, ui){ location.href = 'menu.htm'; });
				$('#btnValidar').bind('click', function(event, ui){ validarPaciente(); });
				$('#rutPaciente').blur(function(){ 
					var self = $(this); 
					if (self.val().indexOf('k')){
						self.val(self.val().replace('k','K'));
					} 
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
				<label for="rutPaciente">Rut Paciente</label>
				<input type="text" id="rutPaciente" />
				<label>Previsi&oacute;n</label>
				<select id="cmbPrevision" data-theme="b" data-native-menu="false">
					<option value="0">Seleccione</option>
				</select>
				<ul>
					<li><a data-rel="dialog" href="#wait" data-theme="b" id="btnValidar" data-role="button">Validar Previsi&oacute;n</a></li>
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
			<div data-role="content">
				<h2 id="stdout"></h2>
				<div id="datos">
					<h2 id="lblNombre"></h2>
					<h2 id="lblPlan"></h2>
					<h2 id="lblEstado"></h2>
				</div>
			</div>
		</div>
	</body>
</html>
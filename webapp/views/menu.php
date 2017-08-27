<html lang="es">
	<head>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.min.css">
		<link rel="stylesheet" href="webapp/static/css/welcome.css">
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
		<script src="webapp/static/js/jquery.ui.datepicker-es.js"></script>
		<script src="webapp/static/js/boleta.js"></script>
		<script src="webapp/static/js/paciente.js"></script>
		<script src="webapp/static/js/welcome.js"></script>
		<script>
			$(function(){ init(); });
		</script>
	</head>
	<body>
		<div id="sidebar">
			<ul id="menu">
				<li><a href="javascript:setView('ib')">Imprimir Boleta</a></li>
				<li><a href="javascript:setView('am')">Agendar Manualmente</a></li>
				<li><a href="javascript:setView('cp')">Consultar Paciente</a></li>
				<li><a href="javascript:setView('logout')">Salir</a></li>
			</ul>
		</div>
		<div id="workspace">
			<div id="ib-view" class="frame">
				<h3>Impresi&oacute;n de boleta</h3>
				<div>
					<label>Fecha:</label><input id="ib-datepicker" type="text" />
					<label>Rut:</label><input id="ib-rut" type="text" />
					<button onclick="btnBuscarBoletas_click()">Buscar</button>
				</div>
				<div>
					<table>
						<thead>
							<tr class="ui-widget-header">
								<th>#</th>
								<th>Rut</th>
								<th>Nombre</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tbody id="ib-data"></tbody>
					</table>
				</div>
				<br />
				<button onclick="btnImprimirBoleta_click()">Imprimir</button>
			</div>
			<div id="ageda-view" class="frame">
				<h3>Agenda Manual</h3>
				<div>
					<label>Rut Paciente</label><input type="text" id="rut" /><br />
					<label>Medico</label>
					<select id="am-medicos"><option value="0">Seleccione...</option></select>
					<button onclick="">Buscar</button>
				</div>
				<br />
				<table>
					<thead>
						<tr class="ui-widget-header">
							<th>Paciente</th>
							<th>Medico</th>
						</tr>
					</thead>
					<tbody id=""></tbody>
				</table>
				<br />
				<button onclick="btnAgendar_click()">Agendar</button>
			</div>
			<div id="paciente-view" class="frame">
				<h3>Consultar Paciente</h3>
				<div>
					<label>Rut </label><input type="text" id="rutConsultarPaciente" />
					<label>Prevision</label>
					<select id="prevision"><option value="1">Fonasa</option></select>
					<button onclick="btnBuscarPacienteCertif_click()">Buscar</button>
				</div>
				<br />
				<table>
					<thead>
						<tr class="ui-widget-header">
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>Fecha Nacimiento</th>
							<th>Genero</th>
							<th>Plan</th>
						</tr>
					</thead>
					<tbody id="target"><tr></tr></tbody>
				</table>
				<br />
				<div id="status"><span style="float: left; margin: 2px 5px"></span><label></label></div>
			</div>
		</div>
		<div id="wait" title="Aviso">Espere por favor...</div>
	</body>
</html>
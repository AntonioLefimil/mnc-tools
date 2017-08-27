<html>
	<head>
		<title>mini tools</title>
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
		<link rel="stylesheet" href="webapp/static/css/common.mobile.css">
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
		<script>
			$(function(){
				$('#btnVolver').bind('click', function(event, ui){ location.href = 'menu.htm'; });
				
				$.getJSON('getVisibilidadTeclado.htm')
				.done(function(d){
					var valor = (d.CodResult == 'E')?'on':'off';
					$('#slider').find('[value="'+valor+'"]').attr('selected', 'selected');
					$('#slider').slider('refresh');
				});

				$("#slider").on('slidestop', function( event ) {
					var val = ($(this).val() == 'on')?1:0;
					$.getJSON('setVisibilidadTeclado.htm', { 'valor' : val })
					.fail(function(){ alert("A ocurrido un error en el servidor"); })
					.done(function(d){ alert("Visibilidad cambiada con exito"); });
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
				<div data-role="fieldcontain">
					<label for="slider">Visible</label>
					<select id="slider" data-role="slider" data-track-theme="c" data-theme="c">
					    <option value="off">NO</option>
					    <option value="on">SI</option>
					</select>
				</div>
			</div>
			<div data-role="footer" data-theme="c" data-position="fixed">
				<ul>
					<li><a id="btnVolver" data-theme="b" data-role="button" class="backButton">Volver</a></li>
				</ul>
			</div>
		</div>
	</body>
</html>
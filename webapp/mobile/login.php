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
				$('#btnLogin')
				.buttonMarkup({ theme: "b" })
				.bind('click', function(event, ui){
					var out = $("#stdout");
					out.text('Cargando...');
					try {
						if ($('#txtUser').val().length == 0){ throw 'Ingrese Usuario'; }
						if ($('#txtPass').val().length == 0){ throw 'Ingrese Clave'; }
						$('form').submit();
					}
					catch(e){ out.text(e); }
				});
			});
		</script>
	</head>
	<body>
		<div data-role="page" id="page" data-theme="c">
			<div data-role="header" id="header" data-theme="c" align="center">
				<img src="webapp/static/img/mnc-logo.png" border="0" />
			</div>
			<div data-role="content">
				<form action="signin.htm" method="POST" data-ajax="false">
					<div id="form" data-role="fieldcontain">
						<label for="name">Usuario:</label><br />
						<input id="txtUser" name="user" type="text" />
						<br />
						<label for="pass">Contrase&ntilde;a:</label><br />
						<input name="password" type="password" id="txtPass" />
						<a id="btnLogin" data-rel="dialog" href="#wait" class="backButton">Login</a>
					</div>
				</form>
			</div>
		</div>
		<div data-role="dialog" id="wait">
			<div data-role="header"><h1>Aviso</h1></div>
			<div data-role="content"><p id="stdout" /></div>
		</div>
	</body>
</html>

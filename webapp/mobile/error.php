<html>
	<head>
		<title>mini tools</title>
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
		<link rel="stylesheet" href="webapp/static/css/common.mobile.css">
		<link rel="stylesheet" href="webapp/static/css/login.mobile.css">
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
		<script>
			$(function(){
				$('#btnLogin').bind('click', function(event, ui){ location.href = 'login.htm'; });
			});
		</script>
	</head>
	<body>
		<div data-role="page" id="page" data-theme="b" >
			<div data-role="header" id="header" data-theme="a" align="center">
				<img src="webapp/static/img/mnc-logo.png" border="0" />
			</div>
			<div data-role="content">
				<h1>A ocurrido un error</h1>
				<p>Por favor vuelva a iniciar sesi&oacute;n</p>
			</div>
			<div data-role="footer" data-position="fixed">
				<ul>
					<li><a id ="btnLogin" data-role="button">Login</a></li>
				</ul>
			</div>
		</div>
	</body>
</html>

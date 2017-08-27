
function irA(code){
	var pagina = '';
	switch(code){
		case 1: { pagina='logout.htm'; break; }
		case 2: { pagina='agendarPacienteHome.htm'; break; }
		case 3: { pagina='homeImprimirBoleta.htm'; break; }
		case 4: { pagina='transbank.htm'; break; }
		case 5: { pagina='teclado.htm'; break; }
	}
	location.href=pagina;
}

function inicializar(){
	$('#menu a').buttonMarkup({ theme: "b" });
	$('#btnDevolver').bind('click', function(event, ui){ irA(1); });
	$('#btnAgenPaciente').bind('click', function(event, ui){ irA(2); });
	$('#btnEstadoTeclado').bind('click', function(event, ui) { irA(5); });
	$('#btnBoleta').bind('click', function(event, ui){ irA(3); });
	$('#btnBuscarAtencion').bind('click', function(event, ui){ location.href = 'buscarAtencionPendiente.htm'; });
	$('#btnValidarPrevision').bind('click', function(event,ui){ location.href = 'consultarPrevision.htm'; });
}
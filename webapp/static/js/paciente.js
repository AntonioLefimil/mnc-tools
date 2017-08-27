/**
*	Paciente JS
*/

function btnBuscarPacienteCertif_click(){
	var rut = $('#rutConsultarPaciente').val().replace(/\./g, '');
	var prev = $('#prevision').val();
	$('#target').find('tr').remove();
	
	if ( rut.indexOf('-') == (rut.length-2) ){
		showWaitMessage('open');
		$.getJSON('buscarPaciente.htm', { 'prev' : prev, 'rut': rut })
		.done(function(data){
			if (data.NomBenef.length == 0){
				alert('Rut del paciente incorrecto');
			}
			else {
				var row = $('<td /><td /><td /><td /><td />');
				var result = $('#status');
				var iconResult = 'ui-icon-close';
				var resultClass = 'error';
				
				row.eq(0).text(data.NomBenef);
				row.eq(1).text(data.ApePatBenef + ' ' + data.ApeMatBenef);
				row.eq(2).attr('align', 'center').text(formatDate(data.FecNacBenef));
				row.eq(3).attr('align', 'center').text(decodeGenero(data.SexoBenef));
				row.eq(4).attr('align', 'center').text(data.Plan);
				
				if (data.CodCert) { 
					iconResult = 'ui-icon-check';
					resultClass = "success"; 
				}
				
				result.get(0).className = resultClass;
				result.find('span').get(0).className = 'ui-icon ' + iconResult;
				result.find('label').text(data.DesCert + '...');
				$('#target').append( $('<tr/>').append(row) );
			}
		})
		.fail(function(){ alert('Ha ocurrido un error'); })
		.always(function(){ showWaitMessage('close'); });
	}
	else {
		alert('Run sin guion antes del digito verificador');
	}
}

function decodeGenero(g){ return (g=='M')?'Masculino':'Femenino'; }
function formatDate(d){ var tmp = d.split('/'); return tmp[2]+'-'+tmp[1]+'-'+tmp[0]; }


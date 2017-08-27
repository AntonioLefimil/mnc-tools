/**
* Boleta Js
*/

function btnBuscarBoletas_click(){
	var fecha = $('#ib-datepicker').val();
	if (fecha.length != 10){
		alert('Fecha no valida');
	}
	else {
		var data = $('#ib-data');
		data.find('tr').remove();
		var rut = $('#ib-rut').val();
		showWaitMessage('open');
		$.getJSON('buscarBoleta.htm', { 'fecha' : fecha, 'rut' : rut })
		.done(function(d){
			var max = d.length;
			if (max > 0){
				for(var i = 0; i < max; i++){
					var p = d[i].paciente;
					var row = $('<td /><td /><td /><td />');
					row.eq(0).html( $('<input type="radio" name="ib-value" value="'+d[i].id+'" />') );
					row.eq(1).text(p.rut);
					row.eq(2).text(p.nombres + ' ' + p.apellidoPaterno + ' ' + p.apellidoMaterno);
					row.eq(3).text(decodeEstatus(d[i].estado));
					data.append( $('<tr />').append(row) );
				}
			}
			else {
				alert('No hay resultados');
			}
		})
		.always(function(){ showWaitMessage('close'); });
	}
}

function btnImprimirBoleta_click(){
	var boleta = $("input[type='radio'][name='ib-value']:checked").val();
	if (boleta){
		showWaitMessage('open');
		$.getJSON('imprimirBoleta.htm', { 'boleta': boleta })
		.done(function(d){
			alert(d.status);
		})
		.always(function(){ showWaitMessage('close'); });
	}
	else {
		alert('Seleccione Boleta a Imprimir');
	}
}

function today(){ 
	var tmp = new Date();
	var day = parseInt(tmp.getDate());
	var month = parseInt(tmp.getMonth())+1;
	day = (day<10)?"0"+day:day;
	month = (month<10)?"0"+month:month;
	return day+"/"+month+"/"+tmp.getFullYear(); 
}

function decodeEstatus(e){ return (e=='0')?'OK':'FAIL'; }



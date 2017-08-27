/**
* Welcome JS
*/

function init(){
	$('#wait').dialog({ width: 240, height: 120, modal: true, autoOpen: false});
	$('#menu').menu();
	$('button').button();
	$('#ib-datepicker').datepicker().val(today());
	$('#workspace').find('div').eq(0).fadeIn();
	$.getJSON('getMedicos.htm').done(function(d){
		t = $('#am-medicos');
		for(var i = 0; i < d.length; i++){
			t.append( $('<option/>').text(d[i].nombre).val(d[i].identificacion) );
		}
	});
}

function showWaitMessage(status){ $( "#wait" ).dialog(status); }

function setView(view){
	switch(view){
		case 'ib': { changeView('ib-view'); break; }
		case 'am': { changeView('ageda-view'); break; }
		case 'cp': { changeView('paciente-view'); break; }
		case 'logout': { location.href = "logout.htm"; break; }
	}
}

function changeView(v){
	$('div.frame').hide();
	$('#'+v).show();
}
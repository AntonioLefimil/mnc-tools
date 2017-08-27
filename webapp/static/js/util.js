var util = {
	missing: '---',
	getSucursales: function(callback){
		$.getJSON('sucursales.htm', function(data){
			storage.sucursales = data;
			callback();
		});
	},
	getSucursal: function(index){
		return storage.sucursales[index];
	},
	now : function(format){
		var _hoy = new Date();
		format = format
		.replace(/dd/, ((_hoy.getDate() < 10)?"0"+(_hoy.getDate()):_hoy.getDate()))
		.replace(/mm/, ((_hoy.getMonth()+1 < 10)?"0"+(_hoy.getMonth()+1):_hoy.getMonth()+1))
		.replace(/yyyy/, _hoy.getFullYear());
		return format;
	},
	cutWord: function(word){
		if (word.length > 15){
			word = word.substring(0, 15) + '...';
		}
		return word;
	},
	clearTable: function(table){
		table.find('tr').remove();
	},
	GETSerializer: function(url, params){
		var out = url+'?';
		for (var i in params){
			out += i + '=' + params[i] + '&';
		}
		out = out.substring(0, out.length-1);
		return out;
	}
};

var storage = {
	estados:["pendiente","resulto"],
	sucursales: []
};


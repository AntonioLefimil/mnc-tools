<?php
class Boleta {
	
	private static $BOLETA_PATH = '/MiniclinicV2/PHP/Application/Connectivity/WServer/Boletas/';
	private static $BOLETA_PREFIX = 'Boleta_';
	private static $BOLETA_SUFIX = '.txt';
	
	public $idConsulta;
	public $fechaEmision;
	public $rutReceptor;
	public $nombreReceptor;
	public $monto;
	public $idTipoConsulta;
	public $nombreTipoConsulta;
	public $nombreMedico;
	public $rutMedico;
	public $previsionPaciente;
	public $horaPago;
	public $folio;
	public $timbre;
	
	public static function createBoleta($params){
		$url = self::$BOLETA_PATH.self::$BOLETA_PREFIX.$params['idConsulta'].self::$BOLETA_SUFIX;
		$f = fopen($url, 'a+');
		fwrite($f, '             Miniclinic SpA');
		fwrite($f, chr(10));
		fwrite($f, '            RUT 76.123.917-1');
		fwrite($f, chr(10));
		fwrite($f, chr(10));
		fwrite($f, 'Direcci�n Sucursal:');
		fwrite($f, chr(10));
		fwrite($f, $params['mncSucursal']);
		fwrite($f, chr(10));
		fwrite($f, chr(10));
		fwrite($f, 'Boleta Electr�nica Exenta');
		fwrite($f, chr(10));
		fwrite($f, 'Folio N�:               '.$params['folio']);
		fwrite($f, chr(10));
		fwrite($f, 'Consulta N�:            '.$params['idConsulta']);
		fwrite($f, chr(10));
		fwrite($f, chr(10));
		fwrite($f, 'Por prestaci�n:         '.$params['nombreTipoConsulta']);
		fwrite($f, chr(10));
		fwrite($f, 'C�digo prestaci�n:      '.$params['idTipoConsulta']);
		fwrite($f, chr(10));
		fwrite($f, chr(10));
		fwrite($f, 'Rut M�dico:             '.$params['rutMedico']);
		fwrite($f, chr(10));
		fwrite($f, 'Nombre M�dico:          Dr '.$params['nombreMedico']);
		fwrite($f, chr(10));
		fwrite($f, 'Especialidad:           Medicina General');
		fwrite($f, chr(10));
		fwrite($f, chr(10));
		fwrite($f, 'Paciente:');
		fwrite($f, chr(10));
		fwrite($f, 'Rut:                    '.$params['rutPaciente']);
		fwrite($f, chr(10));
		fwrite($f, 'Nombre:                 '.$params['nombrePaciente']);
		fwrite($f, chr(10));
		fwrite($f, 'Previsi�n:              Particular');
		fwrite($f, chr(10));
		fwrite($f, chr(10));
		fwrite($f, 'Total prestaciones:     '.$params['valorTipoConsulta']);
		fwrite($f, chr(10));
		fwrite($f, 'Forma de pago:');
		fwrite($f, chr(10));
		fwrite($f, 'Caja N�:                '.$params['idKiosco']);
		fwrite($f, chr(10));
		fwrite($f, 'Fecha:                  '.date('d/m/Y'));
		fwrite($f, chr(10));
		fwrite($f, 'Hora:                   '.$params['hora']);
		fwrite($f, chr(10));
		fwrite($f, chr(10));
		fwrite($f, 'En caso de dudas o problemas, cont�ctese con');
		fwrite($f, chr(10));
		fwrite($f, 'nosotros a trav�s del n� 840 07 00,');
		fwrite($f, chr(10));
		fwrite($f, 'e-mail contacto@miniclinic.cl o a trav�s de');
		fwrite($f, chr(10));
		fwrite($f, 'nuestro sitio web  http://www.miniclinic.cl');
		fwrite($f, chr(10));
		fwrite($f, chr(10));
		fwrite($f, '%PDF417%');
		fwrite($f, chr(10));
		fwrite($f, $params['timbre']);
		fwrite($f, chr(10));
		fwrite($f, '%PDF417%');
		fwrite($f, chr(10));
		fwrite($f, chr(10));
		fwrite($f, 'Resoluci�n N� 131 - 17/11/2011');
		fwrite($f, chr(10));
		fclose($f);
	}
	
	public function toString(){
		return json_encode(array(
			'idConsulta' => $this->idConsulta,
			'fechaEmision' => $this->fechaEmision,
			'rutReceptor' => $this->rutReceptor,
			'nombreReceptor' => $this->nombreReceptor,
			'monto' => $this->monto,
			'idTipoonsulta' => $this->idTipoConsulta,
			'nombreTipoConsulta' => $this->nombreTipoConsulta,
			'nombreMedico' => $this->nombreMedico,
			'rutMedico' => $this->rutMedico,
			'previsionPaciente' => $this->previsionPaciente,
			'horaPago' => $this->horaPago
		));
	}
}
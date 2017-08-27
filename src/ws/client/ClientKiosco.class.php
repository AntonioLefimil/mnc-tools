<?php
include_once 'C:/MiniclinicV2/PHP/External/Nusoap/nusoap.php';

class ClientKiosco {
	
	private $wsClient;
	
	public function ClientKiosco(){
		$this->wsClient = new nusoap_client('http://hub.miniclinic.cl/miniclinic/services/KioscoWS?wsdl', true);
	}
	
	public function confirmarConsulta($params){
		return $this->wsClient->call('ConfirmarConsulta', array('paramPago' => 
			array(
				'confirmacion'       => '1',
				'codigoAutorizacion' => $params['codAutorizacion'],
				'fechaTransaccion'   => $params['fechaTrx'],
				'idConsulta'		 => $params['idConsulta'],
				'idTransaccionIMed'  => $params['idTrxImed'],
				'identificacion'	 => $params['paciente'],
				'tipoIdentificacion' => '1',
				'solicitudSMS' 		 => 'false',
				'glosaFallo' 		 => '',
				'tipoFlujo' 	 	 => 'N'
			)
		));	
	}
	
	public function GenerarBono($ID_KIOSCO){
		return $this->wsClient->call('GenerarBonoImed', 
			array(
				'pagoTransbank' 	=>	'1',
				'idConsulta' 		=>	'',
				'idKiosco' 			=>	'',
				'numTransaccion' 	=>	'ID_KIOSCO',
				'numOperacion' 		=>	'',
				'codAutorizacion' 	=>	'',
				'monto' 			=>	'',
				'numeroTarjeta' 	=>	'0',
				'cuotas'			=>	'0'
			)
		);
	}
	
}
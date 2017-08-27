<?php
include_once 'C:/MiniclinicV2/PHP/External/Nusoap/nusoap.php';

class ClientBoletaHelper {
	
	private $wsClient;
	
	public function ClientBoletaHelper(){
		$this->wsClient = new nusoap_client('http://hub.miniclinic.cl:8080/services/BoletaService.php?wsdl', true);
	}
	
	public function obtenerDatosBoleta($idConsulta){
		return $this->wsClient->call('buscarDatosBoleta', array( 
			'DatosRequest' => array(
				'Auth' => array('usuario' => WS_HUB_USER,'clave' => WS_HUB_PASS),
				'idConsulta' => $idConsulta
			))
		);
	}
	
}
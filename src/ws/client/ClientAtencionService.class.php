<?php
include_once 'C:/MiniclinicV2/PHP/External/Nusoap/nusoap.php' ; 

class ClientAtencionService {
	
	private $wsClient;
	
	public function ClientAtencionService (){
		$this->wsClient = new  nusoap_client('http://localhost:8081/mnc-services/services/AtencionService?wsdl', true);
	}
	
	public function marcarAgendado($idConsulta){
		$this->wsClient->call('marcarAgendado', array('idAtencion' => $idConsulta));
	}
}

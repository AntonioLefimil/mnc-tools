<?php
include_once 'C:/MiniclinicV2/PHP/External/Nusoap/nusoap.php';

class ClientPacienteService {
	
	private $wsClient;
	
	public function ClientPacienteService(){
		$this->wsClient = new nusoap_client('http://hub.miniclinic.cl:8080/services/PacienteService.php?wsdl', true);
	}
	
	public function validarPrevisionPaciente($rut, $prevision){
		return $this->wsClient->call('buscarPrevisionPaciente', 
			array('PrevisionRequest' => array(
				'Auth' => array('usuario' => WS_HUB_USER, 'clave' => WS_HUB_PASS),
				'rut' => $rut,
				'prevision' => $prevision
			))
		);
	}
	
	public function getNombrePaciente($rut){
		return $this->wsClient->call('buscarNombrePaciente',
			array('PacienteRequest' => array(
				'Auth' => array('usuario' => WS_HUB_USER, 'clave' => WS_HUB_PASS),
				'rut'  => $rut
			))
		);
	}
}
<?php
include_once 'C:/MiniclinicV2/PHP/External/Nusoap/nusoap.php';

class ClientAppService {
	
	private $wsClient;
	
	public function ClientAppService(){
		$this->wsClient = new nusoap_client('http://hub.miniclinic.cl:8080/services/Servicio.php?wsdl', true);
	}
	
	public function getMedicos(){
		return $this->wsClient->call('listarMedicos', 
			array('Auth' => array('usuario' => WS_HUB_USER,'clave' => WS_HUB_PASS))
		);
	}
	
	public function getCentros(){
		return $this->wsClient->call('listarCentrosMedicos', 
			array('Auth' => array('usuario' => WS_HUB_USER,'clave' => WS_HUB_PASS))
		);
	}
	
	public function getAsistentes(){
		return $this->wsClient->call('listarAsistentes',
			array('Auth' => array('usuario' => WS_HUB_USER,'clave' => WS_HUB_PASS))
		);
	}
	
	public function getPrevisiones(){
		return $this->wsClient->call('listarPrevisiones',
			array('Auth' => array('usuario' => WS_HUB_USER,'clave' => WS_HUB_PASS))
		);
	}
	
	public function getValorTipoConsulta($tipoConsulta){
		return $this->wsClient->call('listarPreciosConsulta', array(
			'PrecioConsultaRequest' => 
				array('Auth' => array( 'usuario'=> WS_HUB_USER, 'clave'  => WS_HUB_PASS),
				'clinica' => ID_CLINICA,
				'tipoConsulta' => $tipoConsulta
			)
		));
	}
}


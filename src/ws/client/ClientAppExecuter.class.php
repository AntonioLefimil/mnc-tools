<?php
include_once 'C:/MiniclinicV2/PHP/External/Nusoap/nusoap.php';

class ClientAppExecuter {
	
	private $wsClient;
	
	public function ClientAppExecuter(){
		$this->wsClient = new nusoap_client('http://localhost:8081/mnc-services/services/AppExecuter?wsdl', true);
	}
	
	public function callIEReboot(){
		return $this->wsClient->call('rebootIE', array());
	}
	
	public function isRunningProcess($name){
		return $this->wsClient->call('isRunningProcess', array('app' => $name));
	}
	
	public function llamarTeclado($estado){
		return $this->wsClient->call('llamarTeclado', array('estado' => $estado));
	}
	
	public function imprimirBoleta($id){
		return $this->wsClient->call('imprimirBoleta', array('id' => $id));
	}
	
}
<?php
include_once 'C:/MiniclinicV2/PHP/External/Nusoap/nusoap.php';

class ClientGenerarFolio {
	
	private $wsClient;
	
	public function ClientGenerarFolio(){
		$this->wsClient = new nusoap_client('http://localhost/miniclinicws/MiniclinicService.asmx?WSDL', true); //Produccion
		$this->wsClient->timeout = 120;
		$this->wsClient->response_timeout = 120;
	}
	
	public function getFolio($params){
		$params = array(
			'emisionDate' 			 => $params['fecha'],
			'rutEmisor' 			 => '76123917-1',
			'razonSocialEmisor'    	 => $params['mncRazonSocial'],
			'giroEmisor' 			 => 'Medicina General',
			'codigoSucursalSII' 	 => '1',
			'dirOrigen'        		 => $params['mncSucursal'],
			'comunaOrigen'           => '',
			'ciudadOrigen' 			 => '',
			'rutReceptor'	   		 => $params['rutPaciente'],
			'razonSocialReceptor'    => $params['nombrePaciente'],
			'direccionReceptor'      => '',
			'mntExe'           		 => $params['valorTipoConsulta'],
			'mntTotal'    			 => $params['valorTipoConsulta'],
			'montoItem'           	 => $params['valorTipoConsulta'], 
			'nombreItemDetalle' 	 => 'Motivo Consulta',
			'vlrCodigo'				 => $params['idTipoConsulta'],
			'descripcionItemDetalle' => $params['nombreTipoConsulta'],
			'tpoCodigo'			 	 => 'EAN128',
			'idKiosco'	   			 => $params['idKiosco'],
			'qtyItem'	   			 => '1',
			'unmdItem'	   			 => 'caja',
			//Campos personalizados
			'especialidadMedico'	=> 'Medicina General',
			'nombreMedico'			=> $params['nombreMedico'],
			'rutMedico'				=> $params['rutMedico'],
			'previsionPaciente'		=> 'Particular',
			'formaPago'				=> '1',
			'horaPago'				=> $params['hora']
		);
		return $this->wsClient->call('CrearDocumento', $params);
	}
	
}

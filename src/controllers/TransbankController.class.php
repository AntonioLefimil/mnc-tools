<?php
class TransbankController extends controller {
	
	public function TransbankController(){
		parent::Controller();
	}

	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function homeTransbank(){
		return "Transbank";
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function homeBuscarAtencionPendiente(){
		return "buscarAtencionPendiente";
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function  homePagoManualTransbank(){
		return "pagoManualTransbank";
	}

	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function ultimaTransaccion(){
		$acum = file_get_contents("C:/VX700/estado.txt");
		return array ($acum);
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 * @ClassDependency: { 'dao.AtencionDAO', 'dao.DataSource' }
	 */
	public function buscarEstadoPendiente(){
		$dao = new AtencionDAO();
		return $dao->buscarPacientePendiente();
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 * @ClassDependency: { 'ws.client.ClientAppService' }
	 */
	public function cargarValorTipoConsulta(){
		$client = new ClientAppService();
		$result =  $client->getValorTipoConsulta();
		if ($result['Header']['CodResult'] == 'F'){
			throw new AjaxException('A ocurrido un error en el servicio: ' + $result['Header']['Detalle']);
		}
		return $result['Response'];
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 * @ClassDependency: { 'ws.client.ClientAppService', 'ws.client.ClientPacienteService', 'dao.DataSource', 'dao.AtencionDAO' }
	 */
	public function cargarNombrePaciente(){
		$id  = $this->request->getParam('id');
		$dao = new AtencionDAO();
		$datos = $dao->buscarDatosVenta($id);
		
		$client = new ClientPacienteService();
		$nombreResult = $client->getNombrePaciente($datos['paciente']);
		
		if ($nombreResult['CodResult'] != 'E'){
			throw new Exception($nombreResult['MsgResult']);
		}
		
		$nombre = $nombreResult['nombres'].' '.$nombreResult['apellidos'];
		$precio = '0';
		
		if ($datos['tipo_atencion'] == 1){
			$clientAppService = new ClientAppService();
			$responseValor = $clientAppService->getValorTipoConsulta($datos['tipo_consulta']);
			if ($responseValor['Header']['CodResult'] != 'E'){
				throw new Exception($reponseValor['Header']['Detalle']);
			}
			$precio = $responseValor['Response']['precio'];
		}
		else if ($datos['tipo_atencion'] == 2){
			$precio = $datos['precio'];
		}
		else {
			throw new Exception('Tipo de atencion no valido => '.$datos['tipo_atencion']);
		}
		
		return array('nombre' => $nombre, 'precio' => $precio, 'tipoAtencion' => $datos['tipo_atencion']);
	}

	/**
	 * @ClassDependency: { 'model.Boleta', 'ws.client.ClientBoletaHelper', 'ws.client.ClientGenerarFolio', 'delegate.BoletaDelegate', 'dao.DataSource', 'dao.AtencionDAO' }
	 * @Privilege: AUTHENTICATED
	 */
	public function generarPago(){
		$tipoAtencion = $this->request->getParam('tipoAtencion');
		$idConsulta = $this->request->getParam('idConsulta');
		$codAutorizacion = $this->request->getParam('codAut');
		if ($tipoAtencion == 1) {
			BoletaDelegate::generarBoleta($idConsulta);
			$dao = new AtencionDAO();
			$dao->actualizarEstadoAtencion($idConsulta, $codAutorizacion);
		}
		else if ($tipoAtencion == 2){
			//TODO hacer logica de generacion de bono
		}
		else {
			throw new Exception('Tipo de atencion no valido => '.$tipoAtencion);
		}
		return array('CodResult' => 'E');
	}
	
}



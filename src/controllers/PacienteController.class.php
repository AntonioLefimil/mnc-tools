<?php
class PacienteController extends controller {
	
	public function PacienteController(){
		parent::Controller();
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function agendarPacienteHome(){
		return "agendarPaciente";
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function consultarPrevision(){
		return "consultarPrevision";
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function consultarConvenio(){
		return "consultarConvenio";
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 * @ClassDependency: { 'ws.client.ClientPacienteService', 'dao.AtencionDAO', 'dao.DataSource' }
	 */
	public function buscarPacienteSinAgendar(){
		$dao = new AtencionDAO();
		$result = $dao->buscarAtencionesSinAgendar();
		$client = new ClientPacienteService();
		for ($i=0; $i < count($result); $i++){
			$tmp = $client->getNombrePaciente($result[$i]['paciente']);
			$result[$i]['nombre'] = $tmp['nombres'].' '.$tmp['apellidos'];
		}
		return $result;
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 * @ClassDependency: { 'dao.AtencionDAO', 'dao.DataSource' }
	 */
	public function contarPacientesSinAgendar(){
		$dao = new AtencionDAO();
		$result = count($dao->buscarAtencionesSinAgendar());
		return array('Count' => $result);
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 * @ClassDependency: { 'dao.AtencionDAO', 'dao.DataSource', 'ws.client.ClientKiosco', 'ws.client.ClientAtencionService' }
	 */
	public function agendarPacienteMiddleware(){
		$idConsulta = $this->request->getParam('idConsulta');
		$dao = new AtencionDAO();
		$result = $dao->buscarDatosParaAgendar($idConsulta);
		
		if (!$result['idTrxImed']){
			$result['idTrxImed'] = '0';
		}
		$client = new ClientKiosco();
		$ccr = $client->confirmarConsulta($result);
		
		if ($ccr['Respuesta']['CodResult'] != 'E'){
			throw new Exception($ccr['Respuesta']['MsgResult']);
		}
		
		$dao->marcarAgendado($idConsulta);
		return array('CodResult' => 'E');
	}
	
	public function getNombrePaciente($id){
		$client = new ClientPacienteService();
		$nombreResult = $client->getNombrePacient($datos['Pacient']);
		return array('nombre' => $nombre);
	}
}




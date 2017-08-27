<?php
class PrevisionController extends Controller {
	
	public function PrevisionController(){
		parent::Controller();
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 * @ClassDependency: { 'ws.client.ClientAppService' }
	 */
	public function findPrevisiones(){
		$client = new ClientAppService();
		$result = $client->getPrevisiones();
		if ($result['Header']['CodResult'] == 'F'){
			throw new AjaxException('A ocurrido un error en el servicio: ' + $result['Header']['Detalle']);
		}
		return $result['Response'];
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 * @ClassDependency: { 'ws.client.ClientPacienteService' }
	 */
	public function validarPrevision(){
		$rut = $this->request->getParam('rut');
		$prevision = $this->request->getParam('prevision');
		$client = new ClientPacienteService();
		$result = $client->validarPrevisionPaciente($rut, $prevision);
		return $result;
	}
	
}
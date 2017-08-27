<?php
class BoletaController extends Controller {
	
	public function BoletaController(){
		parent::Controller();
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function home(){
		return "buscarBoleta";
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function homeImprimirBoleta(){
		return "imprimirBoleta";
	}
	
	/**
	 * @ClassDependency: { 'model.Paciente', 'model.Atencion', 'model.AtencionParticular', 'dao.AtencionParticularDAO', 'dao.DataSource' }
	 * @Privilege: AUTHENTICATED
	 */
	public function buscarBoleta(){
		$dao = new AtencionParticularDAO();
		return $dao->buscarBoletas();
	}
	
	/**
	 * @ClassDependency: { 'ws.client.ClientAppExecuter' }
	 * @Privilege: AUTHENTICATED
	 */
	public function imprimirBoleta(){
		$id = $this->request->getParam('boleta');
		$client = new ClientAppExecuter();
		return $client->imprimirBoleta($id);
	}
}



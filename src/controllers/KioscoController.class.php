<?php
class KioscoController extends Controller {
	
	public function KioscoController(){
		parent::Controller();
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function homeKiosco(){
		return "kiosco";
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 * @ClassDependency: { 'ws.client.ClientAppExecuter' }
	 */
	public function reiniciarExplorer(){
		$client = new ClientAppExecuter();
		return $client->callIEReboot();
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function homeTeclado(){
		return 'teclado';
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 * @ClassDependency: { 'delegate.TecladoDelegate', 'ws.client.ClientAppExecuter' }
	 */
	public function getVisibilidadTeclado(){
		$isRunning = TecladoDelegate::isRunning();
		$isVisible = TecladoDelegate::isVisible();
		return array('CodResult' => ($isRunning AND $isVisible)?'E':'F');
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 * @ClassDependency: { 'delegate.TecladoDelegate', 'ws.client.ClientAppExecuter' }
	 */
	public function setVisibilidadTeclado(){
		$valor = $this->request->getParam('valor');
		$isVisible = TecladoDelegate::isVisible();
		$isRunning = TecladoDelegate::isRunning();
		switch ($valor){
			case '0': {
				if ($isVisible){ TecladoDelegate::writeTeclado('00'); }
				if ($isRunning){ TecladoDelegate::runTeclado(0); }
				break;
			}
			case '1': {
				if (!$isVisible){ TecladoDelegate::writeTeclado('01'); }
				if (!$isRunning){ TecladoDelegate::runTeclado(1); }
				break;
			}
			default: {
				throw new AjaxException("Valor de visibilidad no valido: $valor");
			}
		}		
		return array('CodResult' => 'E');
	}
	
}
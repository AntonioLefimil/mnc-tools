<?php
class HomeController extends Controller {
	
	public function HomeController(){
		parent::Controller();
	}
	
	public function index(){
		return 'login';
	}
	
	public function logout(){
		$this->session->close();
		return 'login';
	}
	
	/**
	 * @ClassDependency: { 'model.Usuario', 'dao.DataSource', 'dao.UsuarioDAO' }
	 */
	public function login(){
		$result = 'login';
		$dao = new UsuarioDAO();
		$user = $this->request->getParam('user');
		$pass = $this->request->getParam('password');
		$u = new Usuario($user, $pass);
		if ( $dao->isActive($u) ){
			$this->session->setUser($u);
			$result = 'signin';
		}
		else { throw new Exception('Usuario no valido'); }
		return $result;
	}
	
	/**
	 * @Privilege: AUTHENTICATED
	 */
	public function menu(){
		return 'menu';
	}
}



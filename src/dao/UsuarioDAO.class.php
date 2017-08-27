<?php
class UsuarioDAO {
	
	private $connection;
	
	public function __construct(){
		$this->connection = new DataSource();
	}
	
	public function isActive(Usuario $usuario){
		$usuario->pass = hash('sha256', $usuario->pass);
		$result = $this->connection->query(
			'SELECT id FROM usuario '.
			"WHERE name='$usuario->user' AND pass='$usuario->pass' AND active=1"
		);
		return $result;
	}
	
}

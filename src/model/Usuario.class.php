<?php
class Usuario {
	
	public $user;
	public $pass;
	public $active;
	public $roles;
	
	public function Usuario($u, $p){
		$this->user = $u; 
		$this->pass = $p;
	}
	
}
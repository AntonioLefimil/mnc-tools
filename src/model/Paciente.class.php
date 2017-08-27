<?php
class Paciente {
	
	public $id;
	public $rut;

	public function Paciente($id, $rut){
		$this->id = $id;
		$this->rut = $rut;	
	}
	
	public function __toString(){
		return array(
			'id' => $this->id,
			'rut' => $this->rut
		);
	}
}


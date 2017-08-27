<?php
class AtencionParticularDAO {
	
	private $connect;
	
	public function AtencionParticularDAO(){
		$this->connect = new DataSource();
	}
	
	public function buscarBoletas(){
		$sql = 'SELECT id, paciente FROM atencion WHERE tipo_atencion = 1 AND fecha = CURDATE()'; 
		return $this->connect->query($sql);
	}
}
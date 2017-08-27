<?php
class PacienteDAO {
	
	private $mysql;
	
	public function __construct(){
		$this->mysql = new DataSource();
	}
	
	public function getPaciente($rut){
		$result = $this->mysql->query(
			'SELECT id, nombre, identificacion, apellido_paterno, apellido_materno, genero, '.
				"DATE_FORMAT(fecha_nacimiento, '%d-%m-%Y') as fecha_nacimiento ".
			'FROM cliente '.
			"WHERE identificacion = '$rut'"
		);
		$paciente = new Paciente();
		$paciente->id = $result[0]['id'];
		$paciente->nombres = $result[0]['nombre'];
		$paciente->rut = $result[0]['identificacion'];
		$paciente->apellidoPaterno = $result[0]['apellido_paterno'];
		$paciente->apellidoMaterno = $result[0]['apellido_materno'];
		$paciente->genero = $result[0]['genero'];
		$paciente->fechaNacimiento = $result[0]['fecha_nacimiento'];
		return $paciente;
	}
	
	public function getSucursales(){
		$result = $this->mysql->query("SELECT id, nombre FROM sucursal");
		$sucursales = array();
		foreach ($result as $tmp){
			array_push($sucursales, new Sucursal($tmp['id'], $tmp['nombre']));
		}
		return $sucursales;
	}

}


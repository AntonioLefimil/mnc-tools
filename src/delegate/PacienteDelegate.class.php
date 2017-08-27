<?php
class PacienteDelegate {
	
	public static function buscarNombrePaciente($rut){
		$client = new ClientPacienteService();
		$nombre = $client->getNombrePaciente($rut);
		
	}
	
	
}
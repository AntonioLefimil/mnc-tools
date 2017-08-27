<?php
class BonoDelegate{
	
	public static function generarBono(){
		$client = new ClientKiosco();
		$result = $client->GenerarBono();
		
		
	}
	
	
}
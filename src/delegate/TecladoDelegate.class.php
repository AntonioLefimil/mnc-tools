<?php
class TecladoDelegate {
	
	static private $teclado_location = 'C:\\Teclado\\cerrar.txt';
	
	public static function isVisible(){
		return (file_get_contents(self::$teclado_location, "r+") == '01');
	}
	
	public static function isRunning(){
		$client = new ClientAppExecuter();
		$rt = $client->isRunningProcess('Wosk.exe');
		return ($rt['CodResult'] == 'E');
	}
	
	public static function writeTeclado($value){
		$a = fopen(self::$teclado_location, 'w+');
		fwrite($a, $value);
		fclose($a);
	}
	
	public static function runTeclado($value){
		$client = new ClientAppExecuter();
		$rt = $client->llamarTeclado($value);
		if ($rt['CodResult'] != 'E'){
			throw new AjaxException('No se ha podido llamar al teclado con valor => '.$value);
		}
	}
	
}
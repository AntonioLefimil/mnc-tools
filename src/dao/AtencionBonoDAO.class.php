<?php
class AtencionBonoDAO {
	
	private $connect;
	
	public function __construct(){
		$this->connect = new DataSource();
	}
	
	public function insertAtencionBono(AtencionBono $bono){
		$sql = 
			'INSERT INTO atencion_bono (id_atencion, monto_total, monto_copago, num_operacion, prevision, folio ) '.
			"VALUES ($bono->id, $bono->montoTotal, $bono->montoCopago, $bono->numOperacion, '$bono->prevision', $bono->folio)";
		return $this->connect->query($sql);
	}
	
}
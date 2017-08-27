<?php
class AtencionDAO {
	
	private $connection;
	
	public function __construct(){
		$this->connection = new DataSource();
	}
	
	public function buscarAtencionAgendar($idConsulta){
		$result = $this->connection->query( 
			'SELECT cod_autorizacion, id_trx_imed, paciente, '.
			"DATE_FORMAT(NOW(), '%Y-%m-%dT%h:%i:%s') as fecha ".
			'FROM atencion '.
			"WHERE id = $idConsulta "
		);
		
		if (!isset($result[0])){ throw new Exception("id de consulta no encontrado => $idConsulta"); }
		return $result[0];
	} 
	
	public function buscarAtencionesSinAgendar(){
		$sql = 'SELECT id, paciente FROM atencion WHERE agendado = 0 AND fecha = CURDATE()'; 
		return $this->connection->query($sql);
	}
	
	public function buscarPacientePendiente(){
		$sql = 'SELECT id, paciente FROM atencion WHERE estado = -1 AND fecha = CURDATE() AND tipo_atencion <> 0';
		return $this->connection->query($sql);
	}
	
	public function buscarDatosVenta($id){
		$result = $this->connection->query( 
			'SELECT tipo_consulta, paciente, tipo_atencion, '.
			"(SELECT monto_copago FROM bono where id_consulta = $id ) as precio ".
			'FROM atencion '.
			"WHERE id = $id ".
			'AND tipo_atencion <> 0'
		);
		
		if (count($result) == 0){ throw new Exception("id de consulta no encontrado => $id"); }
		return $result[0];
	}
	
	public function actualizarEstadoAtencion($idConsulta, $codAut){
		$sql = 
			'UPDATE atencion '.
			'SET estado = 1, cod_autorizacion = '.$codAut.' '.
			'WHERE id = '. $idConsulta;
		return $this->connection->query($sql);
	}
	
	public function buscarDatosParaAgendar($idConsulta){
		$result = $this->connection->query(
			'SELECT '.
				'cod_autorizacion as codAutorizacion, '.
				'DATE_FORMAT(NOW(), \'%Y-%m-%dT%H:%i:%s\') as fechaTrx, '.
				'id as idConsulta, '.
				'(SELECT id_trx_imed FROM bono WHERE id_consulta='.$idConsulta.') as idTrxImed, '.
				'paciente '.
			'FROM atencion '.
			'WHERE id = '.$idConsulta
		);
		if (count($result) == 0){ throw new Exception("id de consulta no encontrado => $idConsulta"); }
		return $result[0];
	}
	
	public function marcarAgendado($idConsulta){
		$sql = 'UPDATE atencion SET agendado = 1 WHERE id = '.$idConsulta;
		return $this->connection->query($sql);
	}
}





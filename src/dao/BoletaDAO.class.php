<?php
class BoletaDAO {
	
	private $mysql;
	
	public function __construct(){
		$this->mysql = new DataSource();
	}
	
	public function insertBoleta(Boleta $b){
		$result = $this->mysql->query(
			"INSERT INTO boleta(".
				"id_consulta, emision_date, ".
				"rut_receptor, rzn_soc_receptor, monto, id_tipo_consulta, tipo_consulta, ".
				"nombre_medico, rut_medico, prevision_paciente, hora_pago".
			") VALUES (".
				"$b->idConsulta, STR_TO_DATE('$b->fechaEmision', '%d/%m/%Y'), ".
				"'$b->rutReceptor', '$b->nombreReceptor', $b->monto, '$b->idTipoConsulta', '$b->nombreTipoConsulta', ".
				"'$b->nombreMedico', '$b->rutMedico', '$b->previsionPaciente', '$b->horaPago'".
			")"
		);
		if ($result AND (strlen($b->folio > 0) && strlen($b->timbre > 0)) ){
			$result = $this->updateTimbre($b);
		}
		return $result;
	}

	public function selectSinFolio(){
		$result = $this->mysql->query('SELECT * FROM boleta WHERE folio IS NULL AND timbre IS NULL');
		$boletas = array();
		while ($row = $result->fetch_assoc()){
			$b = new Boleta();
			$b->idConsulta = $row['id_consulta'];
			$b->fechaEmision = $row['emision_date'];
			$b->rutReceptor = $row['rut_receptor'];
			$b->nombreReceptor = $row['rzn_soc_receptor'];
			$b->monto = $row['monto'];
			$b->idTipoConsulta = $row['id_tipo_consulta'];
			$b->nombreTipoConsulta = $row['tipo_consulta'];
			$b->nombreMedico = $row['nombre_medico'];
			$b->rutMedico = $row['rut_medico'];
			$b->previsionPaciente = $row['prevision_paciente'];
			$b->horaPago = $row['hora_pago'];
			array_push($boletas, $b);
		}
		return $boletas;
	}
	
	public function updateTimbre(Boleta $boleta){
		$result = $this->mysql->query("UPDATE boleta SET folio='$boleta->folio', timbre='$boleta->timbre' WHERE id_consulta = $boleta->idConsulta");
		return $result;
	}

	
}
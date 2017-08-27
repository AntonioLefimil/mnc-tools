<?php
class BoletaDelegate {
	
	/**
	 * Busca los datos de la boleta y la 
	 * @param unknown_type $idConsulta
	 * @param unknown_type $codAut
	 * @throws Exception
	 */
	public static function generarBoleta($idConsulta){
		$client = new ClientBoletaHelper();
		$data = $client->obtenerDatosBoleta($idConsulta);
		
		if ($data['CodResult'] != 'E'){
			throw new Exception($data['MsgResult']);
		}
		
		$data['idConsulta'] = $idConsulta;
		$data['fecha'] = date('Y-m-d');
		$data['hora']  = date('H:i:s');
		
		$cgf = new ClientGenerarFolio();
		$folioResult = $cgf->getFolio($data);
		
		if ($folioResult['CrearDocumentoResult']['Resultado'] != '1'){
			throw new Exception($folioResult['CrearDocumentoResult']['Mensaje']);
		}
		
		$data['folio']  = $folioResult['CrearDocumentoResult']['Folio'];
		$data['timbre'] = $folioResult['CrearDocumentoResult']['Pdf417'];
		
		Boleta::createBoleta($data);
	}
	
}



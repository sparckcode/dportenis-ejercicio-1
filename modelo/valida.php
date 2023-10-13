<?php  

/**
 * Calss valida
 * 
 * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
 */
class Validate
{
	private $response = array();
	private $rutatemp = "temp/";

	/**
	 * Create a response.
	 * 
	 * @param int $codigo
	 * @param string $mensaje
	 * @param array $objeto
	 * 
	 * @return void
	 */
	public function createResponse($codigo, $mensaje = "", $objeto = null): void
	{
		switch ($codigo) {
			case '0':
				$this->response["codigo_respuesta"] = 0;
				$this->response["mensaje"] = "Ok";
				$this->response["listaobjetos"] = $objeto;
			break;				
			case '-1':
				$this->response["codigo_respuesta"] = -1;
				$this->response["mensaje"] = $mensaje;
			break;
		}
	}

	/**
	 * Get response
	 */
	public function getResponse()
	{
		header('Content-Type: application/json');
		echo json_encode($this->response, JSON_PRETTY_PRINT  | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	}

	/**
	 * Export file .json
	 * 
	 * @param string $nombreArchivo
	 * @return void
	 */
	public function exportJson($nombreArchivo){			
		file_put_contents($this->rutatemp .$nombreArchivo, json_encode($this->response), FILE_APPEND | LOCK_EX);
	}
}

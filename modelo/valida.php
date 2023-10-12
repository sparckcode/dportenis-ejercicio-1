<?php  

/**
 * Calss valida
 * 
 * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
 */
class valida
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
	public function CreaRespuesta($codigo, $mensaje = "", $objeto = null): void
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
	 * Get json in array format.
	 * 
	 * @return array
	 */
	public function ObtenerResponse(): array
	{
		return [
			[
			  "tipo" => "carro",
			  "tamanio" => "Grande",
			  "color" => "Green"
			],
			[
			  "tipo" => "moto",
			  "tamanio" => "mediana",
			  "color" => "Blue"
			],
			[
			  "tipo" => "bicicleta",
			  "tamanio" => "chica",
			  "color" => "Green"
			],
			[
			  "tipo" => "avion",
			  "tamanio" => "grande",
			  "color" => "yellow"
			],
			[
			  "tipo" => "lancha",
			  "tamanio" => "grande",
			  "color" => "Red"
			],
			[
			  "tipo" => "moto",
			  "tamanio" => "mediano",
			  "color" => "Red"
			],
		];
	}

	/**
	 * Export file .json
	 * 
	 * @param string $nombreArchivo
	 * @return void
	 */
	public function ExportarJson($nombreArchivo){			
		file_put_contents($this->rutatemp .$nombreArchivo, json_encode($this->response), FILE_APPEND | LOCK_EX);
	}
}

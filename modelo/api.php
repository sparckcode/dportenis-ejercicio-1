<?php

require_once('modelo/valida.php');
require_once('datos/objeto.php');

/**
 * Class api
 * 
 * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
 */
class api
{
	private const TIPO = '1';

	private const METHOD_GET = 'GET';

	private $metodo = null;
	
	/**
	 * @param $metodo
	 */
	public function __construct($metodo)
	{			
		$this->metodo = $metodo;			
	}

	/**
	 * @return void
	 */
	public function call(): void
	{
		try
		{
			// Get query params.
			$tipo = $_GET['tipo'] ?? self::TIPO;
			$nombre = $_GET['nombre'] ?? null;

			switch ($this->metodo) {
				case self::METHOD_GET:
					if ($tipo == self::TIPO) {
						$this->MetodoGet();
					} else if($nombre) {
						$this->exportar($nombre);
					}
				break;
					
				default:
					$mensaje = "Método: " . $metodo . " no implementado.";
					throw new Exception();
				break;
			}				
		} catch (Exception $e) {
			return "Error: " . $e->getMessage();
		}				
	}

	/**
	 * @return void
	 */
	public function MetodoGet(): void
	{			
		try {				
			$Validar = new valida();
			$Valor = [];
			
			$Validar->CreaRespuesta("0", "", $Valor);
			
			echo json_encode($Validar->ObtenerResponse(), JSON_PRETTY_PRINT  | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
		} catch (Exception $e) {
			$Validar->CreaRespuesta("-1", "Error", []);
		}

		$Response = $Validar->ObtenerResponse();
	}

	/**
	 * @param string $nombreArchivo
	 * @return void
	 */
	public function exportar($nombreArchivo): void
	{
		try
		{
			$Validar = new valida();
			$ObjetoColor = new objeto();
			$rutatemp = "temp/";
			$ValorObjeto = $ObjetoColor->ObtenerObjeto();

			$nombreArchivo = $nombreArchivo . ".json";
			file_put_contents($rutatemp . $nombreArchivo, json_encode($ValorObjeto), FILE_APPEND | LOCK_EX);
			$fileName = basename($nombreArchivo);
			$filePath = "../".$rutatemp . $fileName;
			if(!empty($fileName) && file_exists($filePath)){
				//echo "rutatemp: " . $rutatemp . ", nombreArchivo: " . $nombreArchivo . ", filePath: " . $filePath  . ", json: " . json_encode($Respuesta);

				//Define header information
				header('Content-Description: File Transfer');
				header('Content-Type: txt/html');
				header("Cache-Control: no-cache, must-revalidate");
				header("Expires: 0");
				header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
				header('Content-Length: ' . filesize($filePath));
				header('Pragma: public');
				//Clear system output buffer
				flush();

				//Read the size of the file
				readfile($filePath);

				//Terminate from the script
				die();
			}
		} catch(Exception $e) {
			$Validar->CreaRespuesta("-1", "Error", []);
		}
	}
}

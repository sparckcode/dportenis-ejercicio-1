<?php

require_once 'modelo/Validate.php';
require_once 'datos/JsonObject.php';

/**
 * Class Api
 * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
 */
class Api
{
    private const TYPE = '1';

    private const METHOD_GET = 'GET';

    private const NUMBER_ZERO = 0;

    private const NUMBER_ONE_NEGATIVE = -1;

    private $method = null;

    /**
     * Api constructor.
     * @param $method
     * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
     */
    public function __construct($method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
     */
    public function call(): string
    {
        try {
            // Get query params.
            $type = $_GET['tipo'] ?? self::TYPE;
            $name = $_GET['nombre'] ?? null;

            if ($this->method === self::METHOD_GET) {
                if ($type == self::TYPE) {
                    $this->getMethod();
                } elseif ($name) {
                    $this->export($name);
                }
            } else {
                $message = "Método: " . $this->method . " no implementado.";
                throw new Exception($message);
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }


    /**
     * @return void
     */
    public function getMethod(): void
    {
        $validate = new Validate();
        $object = new JsonObject();

        try {
            $value = $object->getObject();
            $validate->createResponse(self::NUMBER_ZERO, "", $value);
            $validate->getResponse();
        } catch (Exception $e) {
            $message = 'Error';
            $validate->createResponse(self::NUMBER_ONE_NEGATIVE, $message, []);
            $validate->getResponse();
        }
    }

    /**
     * @param string $fileName
     * @return void
     */
    public function export(string $fileName): void
    {
        $validate = new Validate();
        $object = new JsonObject();

        try {
            $pathTemp = "temp/";
            $objectValue = $object->getObject();

            $fileName = $fileName . ".json";
            file_put_contents($pathTemp . $fileName, json_encode($objectValue), FILE_APPEND | LOCK_EX);
            $fileName = basename($fileName);
            $filePath = "../" . $pathTemp . $fileName;
            if (!empty($fileName) && file_exists($filePath)) {
                //Define header information
                header('Content-Description: File Transfer');
                header('Content-Type: txt/html');
                header("Cache-Control: no-cache, must-revalidate");
                header("Expires: 0");
                header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
                header('Content-Length: ' . filesize($filePath));
                header('Pragma: public');
                //Clear system output buffer
                flush();

                //Read the size of the file
                readfile($filePath);

                //Terminate from the script
                die();
            }
        } catch (Exception $e) {
            $validate->createResponse("-1", "Error", []);
        }
    }
}

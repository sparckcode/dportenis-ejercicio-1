<?php

/**
 * Class Validate
 * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
 */
class Validate
{
    private const NUMBER_ZERO = 0;

    private const NUMBER_ONE_NEGATIVE = -1;

    private $response = array();

    private $pathTemp = "temp/";

    /**
     * Create a response
     * @param int $code
     * @param string $message
     * @param array $object
     * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
     */
    public function createResponse(
        int $code = self::NUMBER_ONE_NEGATIVE,
        string $message = '',
        array $object = []
    ): void
    {
        if ($code === self::NUMBER_ZERO) {
            $this->response["codigo_respuesta"] = 0;
            $this->response["mensaje"] = "Ok";
            $this->response["listaobjetos"] = $object;
        } else {
            $this->response["codigo_respuesta"] = -1;
            $this->response["mensaje"] = $message;
        }
    }

    /**
     * @return void
     * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
     */
    public function getResponse()
    {
        header('Content-Type: application/json');
        echo json_encode(
            $this->response,
            JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * @param string $fileName
     * @return void
     * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
     */
    public function exportJson(string $fileName): void
    {
        file_put_contents($this->pathTemp . $fileName, json_encode($this->response), FILE_APPEND | LOCK_EX);
    }
}

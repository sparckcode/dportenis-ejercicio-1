<?php

/**
 * Class JsonObject
 * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
 */
class JsonObject
{
    /**
     * @return array
     * @author Marcos Ortega <marcos.ortega@dportenis.com.mx>
     */
    public function getObject(): array
    {
        $response = [];
        $object = [
            "tipo" => "carro",
            "tamanio" => "Grande",
            "color" => "Green"
        ];
        array_push($response, $object);

        $object = [
            "tipo" => "moto",
            "tamanio" => "mediana",
            "color" => "Blue"
        ];
        array_push($response, $object);

        $object = [
            "tipo" => "bicicleta",
            "tamanio" => "chica",
            "color" => "Green"
        ];
        array_push($response, $object);

        $object = [
            "tipo" => "avion",
            "tamanio" => "grande",
            "color" => "yellow"
        ];
        array_push($response, $object);

        $object = [
            "tipo" => "lancha",
            "tamanio" => "grande",
            "color" => "Red"
        ];
        array_push($response, $object);

        $object = [
            "tipo" => "moto",
            "tamanio" => "mediano",
            "color" => "Red"
        ];
        array_push($response, $object);

        return $response;
    }
}

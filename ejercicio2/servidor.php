<?php

    require_once "lib/nusoap.php";

    $namespace = "http://educacionit.com/serviciosSoap";

    class Stock {
        public function agregar($ladrillo) {
            $path = "datos.txt";
            file_put_contents($path, $ladrillo["Tipo"], FILE_APPEND);
            file_put_contents($path, $ladrillo["Tabla"], FILE_APPEND);
            file_put_contents($path, $ladrillo["Canto"], FILE_APPEND);
            file_put_contents($path, $ladrillo["Testa"], FILE_APPEND);
            file_put_contents($path, ";", FILE_APPEND);
            return strval($ladrillo["Tipo"]);
        }
    }

    $server = new soap_server();
    $server->configureWSDL('StockService', $namespace);

    $tipoLadrillo = [
        "Tipo" => ["name" => "TipoLadrillo", "type" => "xsd:string"],
        "Tabla" => ["name" => "Tabla", "type" => "xsd:int"],
        "Canto" => ["name" => "Canto", "type" => "xsd:int"],
        "Testa" => ["name" => "Testa", "type" => "xsd:int"]
    ];

    $server->wsdl->addComplexType('Ladrillo', 'complexType',
        'struct', 'all','', $tipoLadrillo);

    $server->register("Stock.agregar",
    ["Ladrillo" => "tns:Ladrillo"],
    ["return"=>"xsd:string"],
    $namespace,
    false,
    "rpc",
    "encoded",
    "Agrega un ladrillo al stock"
    );

    if ( !isset($HTTP_RAW_POST_DATA))
        $HTTP_RAW_POST_DATA = file_get_contents('php://input');

    $server->service($HTTP_RAW_POST_DATA);
?>
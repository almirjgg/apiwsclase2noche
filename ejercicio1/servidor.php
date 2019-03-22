<?php

    require_once "lib/nusoap.php";

    $namespace = "http://educacionit.com/serviciosSoap";

    class Operaciones {
        public function sumar($a, $b) {
            return $a + $b;
        }
        public function multiplicar($a, $b) {
            return $a * $b;
        }
    }

    $server = new soap_server();
    $server->configureWSDL('OperacionesService', $namespace);

    $server->register("Operaciones.sumar", 
        ["a"=>"xsd:integer", "b"=>"xsd:integer"],
        ["return"=>"xsd:integer"],
        $namespace,
        false,
        "rpc",
        "encoded",
        "Suma dos enteros"
    );

    $server->register("Operaciones.multiplicar",
        ["a"=>"xsd:integer", "b"=>"xsd:integer"],
        ["return"=>"xsd:integer"],
        $namespace,
        false,
        "rpc",
        "encoded",
        "Multiplica dos enteros"
    );

    if ( !isset($HTTP_RAW_POST_DATA))
        $HTTP_RAW_POST_DATA = file_get_contents('php://input');

    $server->service($HTTP_RAW_POST_DATA);
?>
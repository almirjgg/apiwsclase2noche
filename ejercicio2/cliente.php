<?php

    define('WS_WSDL', 'http://localhost/ejercicio2/servidor.php?wsdl');

    $client = new SoapClient(WS_WSDL);
    $metodosDisponibles = $client->__getFunctions();

    foreach ($metodosDisponibles as $metodo) {
        echo "$metodo\n";
    }

    $parametros = ["Ladrillo"=>[
        "Tipo"=>"Maciso", 
        "Tabla"=>182,
        "Canto"=>92,
        "Testa"=>34
    ]];

    $rsp = $client->__call("Stock.agregar", $parametros);
    echo "Resultado operacion: $rsp";

?>
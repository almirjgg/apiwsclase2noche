<?php

    define('WS_WSDL', 'http://localhost/ejercicio1/servidor.php?wsdl');

    $client = new SoapClient(WS_WSDL);
    $metodosDisponibles = $client->__getFunctions();

    foreach ($metodosDisponibles as $metodo) {
        echo "$metodo\n";
    }

    $rsp = $client->__call("Operaciones.sumar", ["a"=>11, "b"=>55]);

    echo "Resultado operacion: $rsp";
?>
<?php

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use Source\Models\Cliente;

require __DIR__."/vendor/autoload.php";

$clientes = (new Cliente())->find()->fetch(true);
$csvCliente = Writer::createFromString(""); 

$csvCliente->insertOne([
    "Id",
    "Nome",
    "Telefone1",
    "Telefone2",
    "Email"
]);

foreach($clientes as $cliente){
    $csvCliente->insertOne([
        $cliente->Id,
        $cliente->Nome,
        $cliente->Telefone1,
        $cliente->Telefone2,
        $cliente->Email
    ]);
}

$csvCliente->output("Clientes.csv");

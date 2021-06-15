<?php

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use Source\Models\Animal;

require __DIR__."/vendor/autoload.php";

$animais = (new Animal())->find()->fetch(true);
$csvAnimal = Writer::createFromString("");

$csvAnimal->insertOne([
    "Id",
    "IdCliente",
    "Nome",
    "Raca",
    "Especie",
    "HistoricoClinico",
    "Nascimento"

]);
foreach($animais as $animal){
    $csvAnimal->insertOne([
        $animal->Id,
        $animal->IdCliente,
        $animal->Nome,
        $animal->Raca,
        $animal->Especie,
        $animal->HistoricoClinico,
        $animal->Nascimento
    ]);  
}

$csvAnimal->output("Animais.csv");
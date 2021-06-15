<?php

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "complicadovet",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",  //padrao de caracteres
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,     //mensagem de erro
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,   //encapsulamento
        PDO::ATTR_CASE => PDO::CASE_NATURAL      //conversão de caracteres
    ]
]);
<?php

namespace Source\Models;
use CoffeeCode\DataLayer\DataLayer;
class Animal extends DataLayer
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        //string "TABLE_NAME", array ["REQUIRED_FIELD_1", "REQUIRED_FIELD_2"], string "PRIMARY_KEY", bool "TIMESTAMPS"
        parent::__construct("animal", ["IdCliente"],"Id", false);
    }
    //,"Nome", "Raça","Especie", "HistoricoClinico", "Nascimento"
    public function add(Cliente $cliente, 
                        string $Nome, 
                        string $Raca, 
                        string $Especie, 
                        string $HistoricoClinico, 
                        string $Nascimento): Animal
    {
        $this->IdCliente = $cliente->Id;
        $this->Nome = $Nome;
        $this->Raca = $Raca;
        $this->Especie = $Especie;
        $this->HistoricoClinico = $HistoricoClinico;
        $this->Nascimento = $Nascimento;

        return $this;
        
    }
}
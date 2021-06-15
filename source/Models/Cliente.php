<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Cliente extends DataLayer{ 

    //(string $entity, array $required, string $primary = 'id', bool $timestamps =true)
    public function __construct(){
        parent::__construct("cliente",["Nome", "Telefone1", "Telefone2", "Email"],"Id",false);

    }

    public function animal(){
        return (new Animal())->find("IdCliente = :uid", "uid={$this->Id}")->fetch(true);
    }
    
}
<?php

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use Source\Models\Cliente;
use Source\Models\Animal;

require __DIR__."/vendor/autoload.php";

/**
 * Recebe os arquivos de upload da página web e adiciona na pasta csvs do projeto
 */
foreach ($_FILES["arquivo"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["arquivo"]["tmp_name"][$key];
        $name = $_FILES["arquivo"]["name"][$key];
        echo $name;
        move_uploaded_file($tmp_name, "C:/xampp/htdocs/desafio-php-2021/csvs/$name");
    }
}

/**
 * Conexão msqli com banco de dados simplesvet
 */
$conexao_simplesvet = new mysqli("localhost", "root", "", "simplesvet");
mysqli_set_charset($conexao_simplesvet,"utf8");

/**
 * Formata o telefone no modelo (xx) xxxxx-xxxx
 */
function formatPhone($number){ // primeiro substr pega apenas o DDD e coloca dentro do (), segundo subtr pega os números do 3º até faltar 4, insere o hifem, e o ultimo pega apenas o 4 ultimos digitos
    $number = preg_replace('/[^0-9]/', '', $number);
    if(strlen($number) == 11){
        $number="(".substr($number,0,2).") ".substr($number,2,-4)." - ".substr($number,-4);
    }
    if(strlen($number) == 10){
        $number="(".substr($number,0,2).") "."9".substr($number,2,-4)." - ".substr($number,-4);    
    }
    return $number;
}

/**
 * Verifica se o email é válido com @ e .com
 */
function valida_email($email) {
    return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email);
}

$stream = fopen(__DIR__."/csvs/Clientes.csv","r" ); // abre o arquivo clientes.csv

$csvCliente = Reader::createFromStream($stream);  //ler o arquivo
$csvCliente->setDelimiter(",");
$csvCliente->setHeaderOffset(0); //ignora a primeira linha do arquivo

$stmt = (new Statement());
$clientes = $stmt->process($csvCliente);

foreach($clientes as $cliente){    // laço de repetição para armazenar cada cliente com suas respectivas informações
    $id = $cliente["Id"];
    $nome = $cliente["Nome"];
    $telefone1 = $cliente["Telefone1"];
    $telefone1= formatPhone($telefone1);
    $telefone2 = $cliente["Telefone2"];
    $telefone2= formatPhone($telefone2);
    $email = $cliente["Email"];
    
    $pessoa = $conexao_simplesvet->query("INSERT INTO pessoas (id,nome) VALUES('$id','$nome')");

    if(valida_email($email)){//verifica se o email é válido
        $contato_email = $conexao_simplesvet->query("INSERT INTO contatos (pessoa_id,tipo,contato) VALUES('$id','email','$email')");
    }

    $tel1 = str_split($telefone1); // transforma a telefone1 em um array de posições
    $tel2 = str_split($telefone2); // transforma a telefone2 em um array de posições

   if($tel1[6] == 3 ){ //verifica se o telefone1 é fixo analisando se a 6ª posicação do array
        $telefone = $conexao_simplesvet->query("INSERT INTO contatos (pessoa_id,tipo,contato) VALUES('$id','fixo','$telefone1')");
    }
    else{
        $telefone = $conexao_simplesvet->query("INSERT INTO contatos (pessoa_id,tipo,contato) VALUES('$id','celular','$telefone1')");
    }

    if($tel2[6] == 3 ){ //verifica se o telefone2 é fixo analisando se a 6ª posicação do array
        $telefone = $conexao_simplesvet->query("INSERT INTO contatos (pessoa_id,tipo,contato) VALUES('$id','fixo','$telefone2')");
    }
    else{
        $telefone = $conexao_simplesvet->query("INSERT INTO contatos (pessoa_id,tipo,contato) VALUES('$id','celular','$telefone2')");
    }
}

$stream = fopen(__DIR__."/csvs/animais.csv","r" ); // abre o arquivo animais.csv

$csvAnimal = Reader::createFromStream($stream); //ler o arquivo

$csvAnimal->setDelimiter(",");
$csvAnimal->setHeaderOffset(0); //ignora a primeira linha do arquivo

$stmt = (new Statement());
$animais = $stmt->process($csvAnimal);
foreach($animais as $animal){ // laço de repetição para armazenar cada animal com suas respectivas informações
    $Id = ($animal["Id"]);
    $IdCliente = ($animal["IdCliente"]);
    $Nome = ($animal["Nome"]);
    $Raca = ($animal["Raca"]);
    $Especie = ($animal["Especie"]);
    $HistoricoClinico = ($animal["HistoricoClinico"]);
    $Nascimento = ($animal["Nascimento"]);
    $Nascimento = implode('-', array_reverse(explode('/', "$Nascimento"))); // formatando data para ser aceita no banco
    
    $consulta_especie = $conexao_simplesvet->query("SELECT 0 FROM especies WHERE nome = '$Especie'"); //consulta se já existe alguma especie com esse nome
    $num_rows = mysqli_num_rows($consulta_especie);
    
    if($num_rows < 1){ //se não existir a especie ela é adicionada ao banco
        $especie = $conexao_simplesvet->query("INSERT INTO especies (nome) VALUES('$Especie')");
    }
    $especie_id = $conexao_simplesvet->query("SELECT id FROM especies WHERE nome = '$Especie'"); //recuperação do id da especie para ser adicionada na raça do animal
    $id_especie =($especie_id->fetch_assoc());
    $id_especie = $id_especie["id"];
   
    $consulta_raca = $conexao_simplesvet->query("SELECT 0 FROM racas WHERE nome = '$Raca'"); //consulta se já existe alguma raça com esse nome
    $num_rows = mysqli_num_rows($consulta_raca);
    if($num_rows < 1){//se não existir a raça ela é adicionada ao banco
        $raca = $conexao_simplesvet->query("INSERT INTO racas (especie_id,nome) VALUES('$id_especie','$Raca')");
    }
    $raca_id = $conexao_simplesvet->query("SELECT id FROM racas WHERE nome = '$Raca'"); //recuperação do id da raça para ser adicionada no animal
    $id_raca =($raca_id->fetch_assoc());
    $id_raca = $id_raca["id"];

    $animal = $conexao_simplesvet->query("INSERT INTO animais (pessoa_id,especie_id,raca_id,nome,nascimento)
                                        VALUES('$IdCliente','$id_especie','$id_raca','$Nome','$Nascimento')"); //Inserindo as informações gerais do animal no banco

}


    

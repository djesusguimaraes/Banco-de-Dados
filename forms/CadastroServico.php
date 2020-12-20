<?php

require '../bd/models/Cliente.php';

include_once '../bd/db.ini.php';

use connPHPPostgres\ServicoModel as ServicoModel;

$Telefone = null;
$Nome = null;
$CPF = null;
// $ID_servico = 0;
$Carro = null;

if(!empty($_POST['cpf'])){
    $CPF = $_REQUEST['cpf'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Nome =  $_REQUEST['nome'];
    $CPF =  $_REQUEST['cpf'];
    $Modelo = $_REQUEST['modelo'];
    $Ano = $_REQUEST['ano'];
    $Carro = $Modelo.$Ano;
    $Telefone =  $_REQUEST['tel'];
    
    // $ID_servico =  $_REQUEST['servico'];

    try {
        $clientRegister = new ServicoModel($pdo);
        $clientRegister->insert($Nome, $CPF, $Carro, $Telefone);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}
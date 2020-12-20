<?php

require '../bd/models/Cliente.php';

include_once '../bd/db.ini.php';

use connPHPPostgres\FuncionarioModel as FuncionarioModel;

$nome_funcionario = null;
$CPF = null;
$ID_funcionario = 0;
$ID_servico = 0;

if(!empty($_POST['id'])){
    $ID_funcionario = $_REQUEST['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome_funcionario =  $_REQUEST['nome'];
    $CPF =  $_REQUEST['cpf'];
    $ID_funcionario = $_REQUEST['id_funcionario'];
    $ID_servico =  $_REQUEST['id_servico'];
    
    // $ID_servico =  $_REQUEST['servico'];

    try {
        $clientRegister = new ServicoModel($pdo);
        $clientRegister->insert($Nome, $CPF, $Carro, $Telefone);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}
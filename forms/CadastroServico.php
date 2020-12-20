<?php

require '../bd/models/Cliente.php';

include_once '../bd/db.ini.php';

use connPHPPostgres\ServicoModel as ServicoModel;

$Nome_servico = null;
$Descricao = null;
$ID_servico = null;

if(!empty($_POST['servico'])){
    $ID_servico = $_REQUEST['servico'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Nome_servico =  $_REQUEST['nome'];
    $Descricao =  $_REQUEST['descricao'];
    $ID_servico = $_REQUEST['servicos'];
    
    try {
        $clientRegister = new ServicoModel($pdo);
        $clientRegister->insert($Nome_servico, $Descricao, $ID_servico);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}
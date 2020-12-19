<?php

require '../database/Cliente.php';

include_once '../database/db.ini.php';

use connPHPPostgres\ClientModel as ClientModel;


$Telefone = null;
$Nome = null;
$CPF = null;
$ID_Servico = 0;
$Carro = null;

if(!empty($_GET['cpf'])){
    $CPF = $_REQUEST['cpf'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Telefone =  $_REQUEST['Telefone'];
    $Nome =  $_REQUEST['Nome'];
    $CPF =  $_REQUEST['CPF'];
    $ID_Servico =  $_REQUEST['ID_Serico'];
    $Carro = $_REQUEST['Carro'];

    try {
        $clientRegister = new ClientModel($conn);
        $clientRegister->insert($Telefone, $Nome, $CPF, $ID_Servico, $Carro);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}

?>
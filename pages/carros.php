<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\CarroModel as CarroModel;

$Carro = new CarroModel($pdo);

$placa = null;
$cpf = null;
$i = 0;

if (!empty($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}

$Carros = $Carro->show($cpf);

if (!empty($_POST['placa'])) {
    $placa = $_POST['placa'];
    try {
        $Carro->deleteByplaca($placa);
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}
?>
<?php
require '../templates/header.php';
?>

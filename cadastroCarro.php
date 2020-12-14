<?php
require 'connForDB.php';


    if (!empty(POST['idClient']))
    {
    $idClient = POST['idClient'];
    }

    if (!empty(POST['idClient'])) {
        $Model = POST['Model'];
    }

    if (!empty(POST['idClient'])) {
        $Ano = POST['Ano'];
    }

    if (!empty(POST['idClient'])) {
        $Pertences = POST['Pertences'];
    }

    $pdo = banco::connect();
    $postgresql = "INSERT INTO Carro (ID_Cliente, Modelo, Ano, Pertences) value (?,?,?,?)";
    $forPDO = $pdo::prepare($postgresql);
    $forPDO->execute(array($idClient, $Model, $Ano, $Pertences));
    banco::disconnect();
    header('Location: index.php');

?>

<!DOCTYPE html>

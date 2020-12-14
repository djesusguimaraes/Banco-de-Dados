<?php
require 'connForDB.php';


    if (!empty(POST['telefone']))
    {
        $telefone = POST['telefone'];
    }

    if (!empty(POST['nome'])) {
        $nome = POST['nome'];
    }

    if (!empty(POST['idClient'])) {
        $idClient = POST['idClient'];
    }

    if (!empty(POST['cpf'])) {
        $cpf = POST['cpf'];
    }

    if (!empty(POST['idServico'])) {
        $idServico = POST['idServico'];
    }

    $pdo = banco::connect();
    $postgresql = "INSERT INTO Cliente (Telefone, Nome, ID_Client, CPF, ID_Serviço) value (?,?,?,?,?)";
    $forPDO = $pdo::prepare($postgresql);
    $forPDO->execute(array($telefone, $nome, $idClient, $cpf, $idServico));
    banco::disconnect();
    header('Location: index.php');

?>

<!DOCTYPE html>

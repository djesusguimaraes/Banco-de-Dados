<?php
require 'connForDB.php';


    if (!empty(POST['idServico']))
    {
        $idServico = POST['idServico'];
    }

    if (!empty(POST['nome'])) {
        $nome = POST['nome'];
    }

    if (!empty(POST['descricao'])) {
        $descricao = POST['descricao'];
    }

    $pdo = banco::connect();
    $postgresql = "INSERT INTO Servico (ID_Servico, Nome, Descrição) value (?,?,?)";
    $forPDO = $pdo::prepare($postgresql);
    $forPDO->execute(array($idServico, $nome, $descricao));
    banco::disconnect();
    header('Location: index.php');

?>
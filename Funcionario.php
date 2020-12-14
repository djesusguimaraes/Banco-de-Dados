<?php
require 'connForDB.php';


    if (!empty(POST['nome']))
    {
        $nome = POST['nome'];
    }

    if (!empty(POST['idFuncionario'])) {
        $idFuncionario = POST['idFuncionario'];
    }

    if (!empty(POST['cpf'])) {
        $cpf = POST['cpf'];
    }

    if (!empty(POST['idFuncao'])) {
        $idFuncao = POST['idFuncao'];
    }

    $pdo = banco::connect();
    $postgresql = "INSERT INTO Servico (Nome, ID_Funcionario, CPF, ID_Função) value (?,?,?,?)";
    $forPDO = $pdo::prepare($postgresql);
    $forPDO->execute(array($nome, $idFuncionario, $cpf, $idFuncao));
    banco::disconnect();
    header('Location: index.php');

?>
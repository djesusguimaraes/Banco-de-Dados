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
<html lang="pt-br">
<header>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="normalize_pure.css">
</header>
    <div id="cadastroFuncionario">
    <form action="" method='POST'>
        <div>
        <label for="nome">Nome Completo: </label>
        <input type="text" id="name">
        <script>
            function rand() {
                document.getElementById("gera").innerHTML = Math.floor(Math.random() * 65536);    
            }
        </script>
        <h4>Número de Identificação:</h4>
        <label for="idFuncionario" id="gera" onclick="rand()">Gerar</label>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" \ pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" \ title="Digite um CPF no formato: xxx.xxx.xxx-xx">
        <label for="idFuncao">Cargo:</label>
        <input type="text">
        </div>
    </form>

    </div>

</html>
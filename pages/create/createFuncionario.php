<?php

require '../../database/models.php';

include_once '../../database/ini.php';

use connPHPPostgres\FuncionarioModel as FuncionarioModel;
$funcionarioRegister = new FuncionarioModel($pdo);

$Nome_funcionario = null;
$CPF = null;
$Telefone = null;
$ID_funcionario = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Nome_funcionario =  $_REQUEST['nome'];
    $CPF =  $_REQUEST['cpf'];
    $Telefone = $_REQUEST['tel'];
    $ID_funcionario = $_REQUEST['funcao'];

    try {
        $funcionarioRegister->insert($Nome_funcionario, $CPF, $Telefone, $ID_funcionario);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}
?>
<?php
require '../../templates/header.php';
?>
<div>
    <form>
    <div class="form-group">
        <label for="exampleInputEmail1">Endereço de email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
        <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Senha</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Senha">
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Clique em mim</label>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
</body>
</html>
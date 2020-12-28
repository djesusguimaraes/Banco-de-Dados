<?php

require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\FuncionarioModel as FuncionarioModel;
$funcionarioRegister = new FuncionarioModel($pdo);

$nome = null;
$cpf = null;
$telefone = null;
$funcao = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome =  $_REQUEST['nome'];
    $cpf =  $_REQUEST['cpf'];
    $telefone = $_REQUEST['tel'];
    $funcao = $_REQUEST['funcao'];

    try {
        $funcionarioRegister->insert($nome, $cpf, $telefone, $funcao);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}

?>
<?php
require '../../templates/header.php';
?>

<div class="container-sm">
<h2><strong>Cadastro de Funcionário</strong></h2>
<form action="createFuncionario.php" method="post">
    <fieldset>
        <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input type="text" class="form-control" max-lenght="80" name="nome" id="nome" placeholder="Seu nome">
            <small id="help" class="form-text text-muted">Campo Obrigatório</small>
        </div>
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" oninput="mascara(this, 'cpf');" class="form-control" max-lenght="14" name="cpf" id="cpf" placeholder="Seu CPF">
            <small id="help" class="form-text text-muted">Campo Obrigatório</small>
        </div>
        <div class="form-group">
            <label for="tel">Telefone</label>
            <input type="text" oninput="mascara(this, 'tel');" class="form-control" max-lenght="14" name="tel" id="tel" placeholder="Ex: (00) 00000-0000">
        </div>
        <div class="form-group">
            <label for="funcao">ID Funcionário</label>
            <input type="text" class="form-control" max-lenght="5" name="funcao" id="funcao" placeholder="Ex: 54234">
        </div>
    </fieldset>
    <button type="submit" class="btn btn-primary">Enviar</button>&nbsp&nbsp&nbsp<input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/funcionarios.php';" />
    </form>
</div>
</body>
</html>
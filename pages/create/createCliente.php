<?php

require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\ClientModel as ClientModel;
use conpostgres\FuncionarioModel as FuncionarioModel;
use conpostgres\ServicoModel as ServicoModel;

$clientRegister = new ClientModel($pdo);
$funcionarioRegister = new FuncionarioModel($pdo);
$servicoRegister = new ServicoModel($pdo);

$Servicos = $servicoRegister->all();
$Funcionarios = $funcionarioRegister->all();


$nome = null;
$cpf = null;
$telefone = null;

if(!empty($_POST['cpf'])){
    $cpf = $_REQUEST['cpf'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome =  $_REQUEST['nome'];
    $cpf =  $_REQUEST['cpf'];
    $telefone =  $_REQUEST['tel'];
    
    try {
        $clientRegister->insert($nome, $cpf, $telefone);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}
?>
<?php
require '../../templates/header.php';
?>
<div class="container" style="margin-top: 30px;">
    <div class="form-inline">
        <a href="http://localhost/javalato/pages/clientes.php"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <h2><strong>Cadastro de Cliente</strong></h2><br>
    </div><br>
    
    <form action="createCliente.php" method="post">
        <fieldset>
            <legend>Dados do Cliente</legend>
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" class="form-control" max-lenght="80" name="nome" id="nome" placeholder="Seu nome">
                <small id="help" class="form-text text-muted">Campo Obrigatório</small>
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" oninput="mascara(this, 'cpf');" class="form-control" max-lenght="14" name="cpf" id="cpf" placeholder="Ex: 000.000.000-00">
                <small id="help" class="form-text text-muted">Campo Obrigatório</small>
            </div>
            <div class="form-group">
                <label for="tel">Telefone</label>
                <input type="text" oninput="mascara(this, 'tel');" max-lenght="14" class="form-control" name="tel" id="tel" placeholder="Ex: (00) 00000-0000">
            </div>
        </fieldset><br>
    <button type="submit" class="btn btn-primary">Enviar</button>&nbsp&nbsp&nbsp<input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/clientes.php';" /> 
    </form>

</div>
</body>
</html>
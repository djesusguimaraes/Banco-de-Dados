<?php

require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\ClientModel as ClientModel;

$clientRegister = new ClientModel($pdo);

$nome = null;
$cpf = null;
$telefone = null;
$modelo = null;
$ano = null;
$carro = null;
$placa = null;

if(!empty($_POST['cpf'])){
    $cpf = $_REQUEST['cpf'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome =  $_REQUEST['nome'];
    $cpf =  $_REQUEST['cpf'];
    $telefone =  $_REQUEST['tel'];
    $modelo = $_REQUEST['modelo'];
    $ano = $_REQUEST['ano'];

    $carro = $modelo.'/ '.$ano;
    
    $placa = $_REQUEST['placa'];    
    
    try {
        $clientRegister->insert($nome, $cpf, $carro, $telefone, $placa);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}
?>
<?php
require '../../templates/header.php';
?>
<div class="container-sm">
    <h2><strong>Cadastro de Cliente</strong></h2>
    <form action="createCliente.php" method="post">
        <fieldset>
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" class="form-control" max-lenght="80" name="nome" id="nome" placeholder="Seu nome">
                <small id="help" class="form-text text-muted">Campo Obrigatório</small>
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" max-lenght="14" name="cpf" id="cpf" placeholder="Seu CPF">
                <small id="help" class="form-text text-muted">Campo Obrigatório</small>
            </div>
            <div class="form-group">
                <label for="tel">Telefone</label>
                <input type="text" class="form-control" max-lenght="14" name="tel" id="tel" placeholder="(00) 00000-0000">
            </div>
        </fieldset>
        
        <fieldset>
            <legend>Dados do Veículo</legend>
            <label for="modelo" class="d-sm-flex">Descrição</label>  
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Modelo">
                </div>
                <div class="col">
                    <input type="number" max-lenght="4" class="form-control" name="ano" id="ano" placeholder="Ano do modelo">
                </div>
            </div>
            
            <div class="form-group">
                <label for="placa">Número da Placa</label>
                <input type="text" class="form-control" max-lenght="80" name="placa" id="placa" placeholder="A placa do seu carro">
            </div>
        </fieldset>
    
    <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
</body>
</html>
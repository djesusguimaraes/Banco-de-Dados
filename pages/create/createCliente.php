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
$modelo = null;
$ano = null;
$carro = null;
$placa = null;
$servico = null;
$funcionario = null;

if(!empty($_POST['cpf'])){
    $cpf = $_REQUEST['cpf'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome =  $_REQUEST['nome'];
    $cpf =  $_REQUEST['cpf'];
    $telefone =  $_REQUEST['tel'];
    $modelo = $_REQUEST['modelo'];
    $ano = $_REQUEST['ano'];

    $carro = $modelo.'/'.$ano;
    
    $placa = $_REQUEST['placa'];    
    $servico = $_REQUEST['servico'];    
    $funcionario = $_REQUEST['funcao'];    
    
    try {
        $clientRegister->insert($nome, $cpf, $carro, $telefone, $placa, $servico, $funcionario);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}
?>
<?php
require '../../templates/header.php';
?>
<div class="container-sm">
    <h2><strong>Cadastro de Cliente</strong></h2><br>
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
        </fieldset>
        
        <fieldset>
            <legend>Dados do Veículo</legend>
            <label for="modelo" class="d-sm-flex">Descrição</label>  
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Ex: Fusca">
                </div>
                <div class="col">
                    <input type="number" max-lenght="4" class="form-control" name="ano" id="ano" placeholder="Ex: 2009">
                </div>
            </div>
            
            <div class="form-group">
                <label for="placa">Número da Placa</label>
                <input type="text" class="form-control" max-lenght="80" name="placa" id="placa" placeholder="Ex: ABC1234">
            </div>
        </fieldset>
        <fieldset>
            <legend>Dados do Serviço</legend>
            <label for="servico">Serviços</label>
            <select class="form-control" id="servico" name="servico" value="" required>
                <option value="" disabled selected>Selecione os Serviços</option>
                <?php foreach ($Servicos as $dado) : ?>
                    <tr>
                        <option value="<?php echo htmlspecialchars($dado['id_servico']); ?>"> <?php echo htmlspecialchars($dado['nome']); ?></option>
                    </tr>
                <?php endforeach; ?>
            </select>
            <br>

            <label for="funcao">Serviços</label>
            <select class="form-control" id="funcao" name="funcao" value="" required>
                <option value="" disabled selected>Selecione o Funcionário</option>
                <?php foreach ($Funcionarios as $dado) : ?>
                    <tr>
                        <option value="<?php echo htmlspecialchars($dado['id_funcionario']); ?>"> <?php echo htmlspecialchars($dado['nome']); ?></option>
                    </tr>
                <?php endforeach; ?>
            </select>

        </fieldset>
    <br>
    <button type="submit" class="btn btn-primary">Enviar</button>    
    </form>

</div>
</body>
</html>
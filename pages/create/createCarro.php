<?php

require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\ClientModel as ClientModel;
use conpostgres\CarroModel as CarroModel;

$Client = new ClientModel($pdo);
$Carro = new CarroModel($pdo);


$placa = null;
$modelo = null;
$ano = null;
$cpf = null;
$url = null;
$texto = null;

if (!empty($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}

$Clientes = $Client->showByCPF($cpf);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $placa =  isset($_REQUEST['placa']) ? $_REQUEST['placa'] : null;
    $modelo =  isset($_REQUEST['modelo']) ? $_REQUEST['modelo'] : null;
    $ano =  isset($_REQUEST['ano']) ? $_REQUEST['ano'] : null;
    $cpf = isset($_REQUEST['cpf']) ? $_REQUEST['cpf']: $Clientes['cpf'];

    if ($placa != null){
        try {
            $Carro->insert($placa, $modelo, $ano, $cpf);
            $url = 1;
        } catch (PDOException $exception) {
            $error = $exception->getMessage();
            $url = $error;
        }
    }
}

if ($url == 1){
    $texto = ("<div class=\"alert alert-success\" role=\"alert\">Veículo cadastrado com sucesso! <a href=\"http://localhost/javalato/pages/carros.php?cpf=$cpf\" ><button class=\"btn btn-outline-success btn-sm float-right\" style=\"padding: 5px; margin-top: -4px;\">Voltar à seleção</button></a></div>");
}else if($url != null){
    $texto = ("<div class=\"alert alert-danger\" role=\"alert\">$url<a href=\"http://localhost/javalato/pages/carros.php?cpf=$cpf\" ><button class=\"btn btn-outline-danger btn-sm float-right\" style=\"padding: 5px; margin-top: 0px;\">Voltar à seleção</button></a></div>");
}
?>
<?php
require '../../templates/header.php';
?>
<div class="container-sm" style="margin-top: 30px;">
    <div class="form-inline">
        <form action="http://localhost/javalato/pages/carros.php" method="post">
            <input type="hidden" name="cpf" value="<?php echo htmlspecialchars($Clientes['cpf']);?>">
            <button type="submit" class="btn"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></button>
        </form>
        <h2>Cadastro de carro para <?php echo htmlspecialchars($Clientes['nome']) ?></h2>
    </div><br>
    <?php echo $texto; ?>
    <form action="createCarro.php" method="post">
        <fieldset>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Ex: HB20">
                <small id="help" class="form-text text-muted">Campo Obrigatório</small>
            </div>
            <div class="form-group">
                <label for="ano">Ano</label>
                <input type="number" class="form-control" name="ano" id="ano" placeholder="Ex: 1999">
            </div>
            <div class="form-group">
                <label for="placa">Placa</label>
                <input type="text" class="form-control" name="placa" id="placa" placeholder="Ex: ABC1234">
                <small id="help" class="form-text text-muted">Campo Obrigatório</small>
            </div>
            <input type="hidden" name="cpf" id="cpf" value="<?php echo htmlspecialchars($Clientes['cpf']);?>">
        </fieldset><br>
    <button type="submit" class="btn btn-info">Enviar</button>&nbsp&nbsp&nbsp<input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/carros.php?cpf=<?php echo htmlspecialchars($Clientes['cpf']);?>';" /> 
    </form>
</div>
</body>
</html>
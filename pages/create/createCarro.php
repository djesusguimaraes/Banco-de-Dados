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

if (!empty($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}

$Clientes = $Client->showByCPF($cpf);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $placa =  isset($_REQUEST['placa']) ? $_REQUEST['placa'] : ' ';
    $modelo =  isset($_REQUEST['modelo']) ? $_REQUEST['modelo'] : ' ';
    $ano =  isset($_REQUEST['ano']) ? $_REQUEST['ano'] : ' ';
    $cpf = isset($_REQUEST['cpf']) ? $_REQUEST['cpf']: ' ';

    echo $placa, $cpf;

    try {
        $Carro->insert($placa, $modelo, $ano, $cpf);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}
?>
<?php
require '../../templates/header.php';
?>
<div class="container-sm">
    <div class="form-inline">
        <a href="http://localhost/javalato/pages/carros.php"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <h2>Cadastro de carro para <?php echo htmlspecialchars($Clientes['nome']) ?></h2><br>
    </div>
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
    <button type="submit" class="btn btn-info">Enviar</button>&nbsp&nbsp&nbsp<input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/clientes.php';" /> 
    </form>
</div>
</body>
</html>
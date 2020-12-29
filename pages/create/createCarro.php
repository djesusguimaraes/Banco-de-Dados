<?php

require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\ClientModel as ClientModel;
use conpostgres\CarroModel as CarroModel;

$Client = new ClientModel($pdo);
$Carro = new CarroModel($pdo);

$Clientes = $Client->all();

$placa = null;
$modelo = null;
$ano = null;
$cpf = null;

if (!empty($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $placa =  isset($_REQUEST['placa']);
    $modelo =  isset($_REQUEST['modelo']);
    $ano =  isset($_REQUEST['ano']);
    $cpf = isset($_REQUEST['cpf']);

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
    <h2><strong>Cadastro de Carro</strong></h2><br>
    <form action="createCarro.php" method="post">
        <fieldset>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" max-lenght="80" name="modelo" id="modelo" placeholder="Ex: HB20">
                <small id="help" class="form-text text-muted">Campo Obrigatório</small>
            </div>
            <div class="form-group">
                <label for="ano">Ano</label>
                <input type="number" max-lenght="14" class="form-control" name="ano" id="ano" placeholder="Ex: 1999">
            </div>
            <div class="form-group">
                <label for="placa">Placa</label>
                <input type="text" class="form-control" max-lenght="80" name="placa" id="placa" placeholder="Ex: ABC1234">
                <small id="help" class="form-text text-muted">Campo Obrigatório</small>
            </div>
            <input type="hidden" name="cpf" id="cpf" value="<?php echo htmlspecialchars($cpf);?>">
        </fieldset><br>
    <button type="submit" class="btn btn-info">Enviar</button>&nbsp&nbsp&nbsp<input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/clientes.php';" /> 
    </form>
</div>
</body>
</html>
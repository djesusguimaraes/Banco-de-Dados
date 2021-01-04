<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ClientModel as ClientModel;
use conpostgres\CarroModel as CarroModel;

$Carro = new CarroModel($pdo);
$Clientes = new ClientModel($pdo);

$placa = null;
$cpf = null;
$nomeCar = null;
$texto = null;
$i = 0;

if (!empty($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}

if (!empty($_GET['cpf'])){
    $cpf = $_GET['cpf'];
    $placa = isset($_GET['placa'])?$_GET['placa']:null;
}

if (!empty($_POST['confirm'])){
    $placa = $_POST['confirm'];
    $cpf = $Carro->showByPlaca($placa)['cpf'];
    $nomeCar = $Carro->showByPlaca($placa)['modelo'].'/'.$Carro->showByPlaca($placa)['ano'];
    $texto = "
    <div class=\"alert alert-warning\" role=\"alert\">
        <form action=\"http://localhost/javalato/pages/carros.php\" method=\"post\">
            <div class=\"\">
                Você quer realmente apagar o carro $nomeCar?
                <input type=\"hidden\" name=\"placa\" id=\"placa\"value=\"$placa\">
                <input type=\"hidden\" name=\"cpf\" id=\"cpf\"value=\"$cpf\">
            </div><br>
            <input type=\"button\" class=\"btn btn-success btn-sm\" name=\"cancel\" value=\"Cancelar\" onClick=\"window.location='http://localhost/javalato/pages/carros.php?cpf=$cpf';\" />
            <button type=\"submit\" name=\"apagou\" class=\"btn btn-outline-danger btn-sm\">Confirmar</button>
        </form>&nbsp
    </div>";
}

$Carros = $Carro->show($cpf);
$Cliente = $Clientes->showByCPF($cpf);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = isset($_POST['cpf'])?$_POST['cpf']:null;
    if (empty($_POST['cancel'])){
        $placa = isset($_POST['placa'])?$_POST['placa']:null;
    }
    try {
        $Carro->deleteByplaca($placa);
        if ($placa != null){
            header('Location: http://localhost/javalato/pages/carros.php?cpf='.$cpf.'&placa='.$placa);
        }
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo $error;
    }
}
?>
<?php
require '../templates/header.php';
?>
<div class="container" style="margin-top: 30px;">
    <div class="form-inline">
        <a href="http://localhost/javalato/pages/clientes.php"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <h2><strong>Carros de <?php echo htmlspecialchars($Cliente['nome']); ?></strong></h2><br>
    </div>
    <form action="http://localhost/javalato/pages/create/createCarro.php" method="post">
        <input type="hidden" name="cpf" id="cpf" value="<?php echo htmlspecialchars($Cliente['cpf']);?>">
        <button type="submit" class="btn btn-success btn-md float-sm-right">Inserir</button>
    </form><br>&nbsp
    <?php echo $texto; ?>
    <table class="table" style="border-bottom: 1px solid #005484; border-right: 1px solid #005484; border-left: 1px solid #005484; box-shadow: 0px 3px 5px #ccc;">
    <thead class="thead-dark">
        <tr>
            <th style="background-color: #005484;" scope="col">#</th>
            <th style="background-color: #005484;" scope="col">Modelo</th>
            <th style="background-color: #005484;" scope="col">Ano</th>
            <th style="background-color: #005484;" scope="col">Placa</th>
            <th style="background-color: #005484;" scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Carros as $dado) : ?>
            <tr>
                <td class="table-info" style="border-right: 1px solid #005484;"><strong><?php echo $i += 1;?></strong></td>
                <td><?php echo htmlspecialchars($dado['modelo']);?></td>
                <td><?php echo htmlspecialchars($dado['ano']);?></td>
                <td><?php echo htmlspecialchars($dado['placa']); ?></td>
                <td>    
                    <div class="form-check-inline">
                        <form action="carros.php" method="post">
                            <input type="hidden" name="confirm" id="confirm" value="<?php echo htmlspecialchars($dado['placa']); ?>">
                            <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                        </form>&nbsp
                        <form action="update/upCarro.php" method="post">
                            <input type="hidden" name="uplaca" id="uplaca" value="<?php echo htmlspecialchars($dado['placa']);?>">
                            <input type="hidden" name="cpf" id="cpf" value="<?php echo htmlspecialchars($dado['cpf']);?>">
                            <button type="submit" class="btn btn-outline-info btn-sm"?>Update</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
<div class="col"></div>
</div>

</body>
</html>
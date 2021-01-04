<?php
require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\CarroModel as CarroModel;

$Carro = new CarroModel($pdo);

$placa = null;
$cpf = null;
$modelo = null;
$ano = null;

if(!empty($_POST['uplaca'])){
    $placa = $_POST['uplaca'];
    $cpf = $_POST['cpf'];
}

if(!empty($_GET['uplaca'])){
    $placa = $_GET['uplaca'];
    $texto = $_GET['texto'];
}

$Carros = $Carro -> showByPlaca($placa);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $modelo = isset($_REQUEST['modelo']) ? $_REQUEST['modelo'] : $Carros['modelo'];
    $ano = isset($_REQUEST['ano']) ? $_REQUEST['ano'] : $Carros['ano'];
    $cpf = isset($_REQUEST['cpf']) ? $_REQUEST['cpf'] : $Carros['cpf'];
    $placa = isset($_REQUEST['uplaca']) ? $_REQUEST['uplaca'] : $Carros['placa'];

    try {
        if (!empty($_REQUEST['modelo'])){
            $Carro -> update($placa, $modelo, $ano);
            $texto = ("<div class=\"alert alert-success\" role=\"alert\">Informações do veículo atualizadas com sucesso!<a href=\"http://localhost/javalato/pages/carros.php?cpf=$cpf\" ><button class=\"btn btn-outline-success btn-sm float-right\" style=\"padding: 5px; margin-top: -4px;\">Voltar à seleção</button></a></div>");
        }
        header('Location: http://localhost/javalato/pages/update/upCarro.php?uplaca='.$placa.'&texto='.$texto);
    }catch (PDOExpection $expection) {
        $error = $expection -> getMessage();
        echo $error;
    }
}
?>
<?php 
    require '../../templates/header.php';
?>

    <div class="container-sm" style="margin-top: 30px;">
        <h2><strong></strong></h2><br>
        <div class="form-inline">
            <form action="http://localhost/javalato/pages/carros.php" method="post">
                <input type="hidden" name="cpf" value="<?php echo htmlspecialchars($Carros['cpf']);?>">
                <button type="submit" class="btn"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></button>
            </form>
            <h2>Update veículo, placa: <?php echo htmlspecialchars($Carros['placa'])?></h2><br>
        </div><br>
        <?php if(!empty($_GET['uplaca'])): ?>
            <?php echo $texto; ?>
            <form action="upCarro.php" method="post">
                <fieldset>
                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <input type="text" class="form-control" name="modelo" id="modelo" placeholder="<?php echo isset($Carros['modelo']) ? $Carros['modelo'] : 'Digite novo modelo' ?>" >
                    </div>
                    <div class="form-group">
                        <label for="ano">Ano</label>
                        <input type="number" class="form-control" name="ano" id="ano" placeholder="<?php echo isset($Carros['ano']) ? $Carros['ano'] : 'Digite nova ano' ?>" >
                    </div>
                </fieldset><br>
                <input type="hidden" name="cpf" id="cpf" value="<?php echo $Carros['cpf'];?>">
                <input type="hidden" name="uplaca" id="uplaca" value="<?php echo $Carros['placa'];?>">
                <button type="submit" class="btn btn-primary">Update</button>
                <input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/carros.php?cpf=<?php echo $Carros['cpf']; ?>';" />
            </form>
        <?php endif ?>
    </div>
</body>
</html>
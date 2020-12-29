<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ClientModel as ClientModel;
use conpostgres\CarroModel as CarroModel;

$Carro = new CarroModel($pdo);
$Clientes = new ClientModel($pdo);

$placa = null;
$cpf = null;
$i = 0;

if (!empty($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}

$Carros = $Carro->show($cpf);
$Cliente = $Clientes->showByCPF($cpf);

if (!empty($_POST['placa'])) {
    $placa = $_POST['placa'];
    try {
        $Carro->deleteByplaca($placa);
    } catch (PDOException $e) {
        $error = $e->getMessage();
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
    </form>
    <a href=""></a><br>&nbsp
    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Modelo</th>
        <th scope="col">Ano</th>
        <th scope="col">Placa</th>
        <th scope="col">Ações</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($Carros as $dado) : ?>
            <tr>
            <td><?php echo $i += 1;?></td>
            <td><?php echo htmlspecialchars($dado['modelo']);?></td>
            <td><?php echo htmlspecialchars($dado['ano']);?></td>
            <td><?php echo htmlspecialchars($dado['placa']); ?></td>
            <td>    
            <div class="form-inline">
                <form action="carros.php" method="post">
                    <input type="hidden" name="placa" id="placa" value="<?php echo htmlspecialchars($dado['placa']); ?>">
                    <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                </form>
                <form action="update/upCliente.php" method="post">
                    <input type="hidden" name="uplaca" id="uplaca" value="<?php echo htmlspecialchars($dado['placa']);?>">&nbsp&nbsp
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
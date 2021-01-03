<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ClientModel as ClientModel;
use conpostgres\CarroModel as CarroModel;

$Client = new ClientModel($pdo);
$Car = new CarroModel($pdo);
$date = new DateTime('now');

$Clientes = $Client->all();

$cpf = null;
$mostra = null;
$url = null;
$texto = null;
$data = null;
$i = 0;

if (!empty($_POST['confirm'])){
    $cpf = $_POST['confirm'];
    $data = $date->format('Y-m-d');
    $url = 1;
}

if ($url != null){
    $texto = "
    <div class=\"alert alert-danger\" role=\"alert\">
        Você quer realmente apagar o cliente?<br>
        <form action=\"http://localhost/javalato/pages/clientes.php\" method=\"post\">
            <input type=\"hidden\" name=\"cpf\" id=\"cpf\"value=\"<?php echo htmlspecialchars($cpf); ?>\">
            <input type=\"hidden\" name=\"delete_at\" id=\"delete_at\" value=\"<?php echo $data; ?>\">
            <div class=\"form-check-inline\">
                <input type=\"button\" class=\"btn btn-outline-danger\" name=\"cancel\" value=\"Cancel\" onClick=\"window.location='http://localhost/javalato/pages/clientes.php?id=1';\" />&nbsp
                <button type=\"submit\" class=\"btn btn-danger btn-sm\"?>Sim</button>&nbsp
            </div>
        </form>&nbsp
    </div>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_GET['id'])){
        $mostra = isset($_POST['delete_at'])?$_POST['delete_at']:$data;
        $cpf = isset($_POST['cpf'])?$_POST['cpf']:$cpf;
    }
    try {
        $Client->hide($mostra, $cpf);
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}

?>
<?php
require '../templates/header.php';
?>
<div class="container" style="margin-top: 30px">
    <div class="">
        <div class="form-inline">
            <a href="http://localhost/javalato/"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>
            <h2 style="margin: 0px auto auto 20px;"><strong>Clientes</strong></h2><br>
        </div>
        
        <a href="create/createCliente.php"><button type="button" class="btn btn-success btn-md float-sm-right">Cadastrar Cliente</button></a><br>&nbsp
        
        <table class="table" style="border-bottom: 1px solid #005484; border-right: 1px solid #005484; border-left: 1px solid #005484;">
            <thead class="thead-dark">
                <tr>
                    <th style="background-color: #005484;" scope="col">#</th>
                    <th style="background-color: #005484;" scope="col">CPF</th>
                    <th style="background-color: #005484;" scope="col">Nome</th>
                    <th style="background-color: #005484;" scope="col">Telefone</th>
                    <th style="background-color: #005484;" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Clientes as $dado) : ?>
                    <?php if ($dado['delete_at'] == null):?>
                        <tr style="font-size: 11pt;">
                            <td class="table-info" style=" border-right: 1px solid #005484;"><?php echo $i += 1;?></td>
                            <td><?php echo htmlspecialchars($dado['cpf']); ?></td>
                            <td><?php echo htmlspecialchars($dado['nome']); ?></td>
                            <td><?php echo htmlspecialchars($dado['telefone']); ?></td>
                            <td>
                                <div class="form-check-inline">
                                    <form action="clientes.php" method="post">
                                        <input type="hidden" name="confirm" value="<?php echo htmlspecialchars($dado['cpf']); ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                                    </form>&nbsp
                                    <form action="update/upCliente.php" method="post">
                                        <input type="hidden" name="cpf" id="cpf" value="<?php echo htmlspecialchars($dado['cpf']);?>">
                                        <button type="submit" class="btn btn-outline-info btn-sm"?>Update</button>
                                    </form>&nbsp
                                    <form action="carros.php" method="post">
                                        <input type="hidden" name="cpf" value="<?php echo htmlspecialchars($dado['cpf']);?>">
                                        <button type="submit" class="btn btn-outline-success btn-sm"?><?php if (!empty(count($Carros = $Car->show($dado['cpf'])))){echo count($Carros = $Car->show($dado['cpf']));};?> Carros</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endif;?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $texto; ?>
    </div>
</div>
</body>
</html>
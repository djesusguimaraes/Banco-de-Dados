<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ClientModel as ClientModel;
use conpostgres\FuncionarioModel as FuncionarioModel;
use conpostgres\ServicoModel as ServicoModel;
use conpostgres\CarroModel as CarroModel;

$Client = new ClientModel($pdo);
$Funcionario = new FuncionarioModel($pdo);
$Servico = new ServicoModel($pdo);
$Car = new CarroModel($pdo);
$date = new DateTime('now');

$Clientes = $Client->all();

$cpf = null;
$mostra = null;
$i = 0;

if (!empty($_POST['cpf'])) {
    $mostra = $_POST['delete_at'];
    $cpf = $_POST['cpf'];
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
<!--  -->
<script type="text/javascript">
    function apagar(){

    }

</script>
<div class="container" style="margin-top: 30px">
    <div class="">
        <div class="form-inline">
            <a href="http://localhost/javalato/"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>
            <h2 style="margin: 0px auto auto 20px;"><strong>Clientes</strong></h2><br>
        </div>
        <a href="create/createCliente.php"><button type="button" class="btn btn-success btn-md float-sm-right">Cadastrar Cliente</button></a><br>&nbsp
        <table class="table" style="margin-top: 10px">
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
                            <td class="table-info"><?php echo $i += 1;?></td>
                            <td><?php echo htmlspecialchars($dado['cpf']); $cpfAtual = $dado['cpf']; ?></td>
                            <td><?php echo htmlspecialchars($dado['nome']); ?></td>
                            <td><?php echo htmlspecialchars($dado['telefone']); ?></td>
                            <td>
                                <div class="form-inline">
                                    <?php $cpf = $dado['cpf']; $data = $date->format('Y-m-d');?>
                                    <button class="btn btn-outline-danger btn-sm" onclick="apagar();">Delete</button>&nbsp
                                    <!-- <form action="clientes.php" method="post">
                                        <input type="hidden" name="cpf" value="<?php echo htmlspecialchars($dado['cpf']); ?>">
                                        <input type="hidden" name="delete_at" value="<?php echo $date->format('Y-m-d'); ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                                    </form>&nbsp -->
                                    <form action="update/upCliente.php" method="post">
                                        <input type="hidden" name="cpf" id="cpf" value="<?php echo htmlspecialchars($dado['cpf']);?>">
                                        <button type="submit" class="btn btn-outline-info btn-sm"?>Update</button>
                                    </form>&nbsp
                                    <form action="carros.php" method="post">
                                        <input type="hidden" name="cpf"value="<?php echo htmlspecialchars($dado['cpf']);?>">
                                        <button type="submit" class="btn btn-outline-success btn-sm"?><?php if (!empty(count($Carros = $Car->show($dado['cpf'])))){echo count($Carros = $Car->show($dado['cpf']));};?> Carros</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endif;?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
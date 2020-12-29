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

$Clientes = $Client->all();


$cpf = null;
$i = 0;

if (!empty($_POST['cpf'])) {
    $cpf = $_POST['cpf'];
    try {
        $Client->deleteByCPF($cpf);
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
            <a href="http://localhost/javalato/"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <h2><strong>Clientes</strong></h2><br>
        </div>
        <a href="create/createCliente.php"><button type="button" class="btn btn-success btn-md float-sm-right">Inserir</button></a><br>&nbsp
        <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">CPF</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Ações</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($Clientes as $dado) : ?>
                <tr>
                <td><?php echo $i += 1;?></td>
                <td><?php echo htmlspecialchars($dado['cpf']); $cpfAtual = $dado['cpf']; ?></td>
                <td><?php echo htmlspecialchars($dado['nome']); ?></td>
                <td><?php echo htmlspecialchars($dado['telefone']); ?></td>
                <td>
                <div class="form-inline">
                    <form action="clientes.php" method="post">
                        <input type="hidden" name="cpf"value="<?php echo htmlspecialchars($dado['cpf']); ?>">
                        <button type="submit" class="btn btn-danger btn-sm"?>Delete</button>
                    </form>
                    <form action="update/upCliente.php" method="post">
                        <input type="hidden" name="cpf" id="cpf" value="<?php echo htmlspecialchars($dado['cpf']);?>">&nbsp&nbsp
                        <button type="submit" class="btn btn-info btn-sm"?>Update</button>
                    </form>
                    <form action="carros.php" method="post">
                        <input type="hidden" name="cpf"value="<?php echo htmlspecialchars($dado['cpf']);?>">&nbsp&nbsp
                        <button type="submit" class="btn btn-outline-success btn-sm"?>Carros <?php if (!empty(count($Carros = $Car->show($dado['cpf'])))){echo count($Carros = $Car->show($dado['cpf']));};?></button>
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
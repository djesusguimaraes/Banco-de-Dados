<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ClientModel as ClientModel;
use conpostgres\FuncionarioModel as FuncionarioModel;
use conpostgres\ServicoModel as ServicoModel;

$Client = new ClientModel($pdo);
$Funcionario = new FuncionarioModel($pdo);
$Servico = new ServicoModel($pdo);

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
<div class="justify-content-center">
    <div class="col">
    <h2><strong>Clientes</strong></h2><br>
        <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">CPF</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Carro</th>
            <th scope="col">Placa</th>
            <th scope="col">Serviço</th>
            <th scope="col">Preço</th>
            <th scope="col">Funcionário</th>
            <th scope="col">Ações</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($Clientes as $dado) : ?>
                <tr>
                <td><?php echo $i += 1;?></td>
                <td><?php echo htmlspecialchars($dado['cpf']); ?></td>
                <td><?php echo htmlspecialchars($dado['nome']); ?></td>
                <td><?php echo htmlspecialchars($dado['telefone']); ?></td>
                <td><?php echo htmlspecialchars($dado['carro']); ?></td>
                <td><?php echo htmlspecialchars($dado['placa']); ?></td>
                <td><?php echo htmlspecialchars($Servico->showByID($dado['id_servico'])['nome']); ?></td>
                <td><?php echo htmlspecialchars($Servico->showByID($dado['id_servico'])['preco']); ?></td>
                <td><?php echo htmlspecialchars($Funcionario->showByID($dado['id_funcionario'])['nome']); ?></td>
                <td>
                <div class="d-inline-block">
                    <form action="clientes.php" method="post">
                        <input type="hidden" name="cpf"value="<?php echo htmlspecialchars($dado['cpf']); ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                    </form>
                    <form action="clientes.php" method="post">
                        <input type="hidden" name="cpf" value="">
                    </form>
                </div>
                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
</div>
<div class="col"><a href="create/createCliente.php"><button type="button" class="btn btn-outline-success btn-lg">Insert</button></a></div>
</div>

</body>
</html>
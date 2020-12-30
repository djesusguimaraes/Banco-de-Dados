<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\PedidoModel as PedidoModel;
use conpostgres\ItemModel as ItemModel;
use conpostgres\ClientModel as ClientModel;
use conpostgres\ServicoModel as ServicoModel;
use conpostgres\FuncionarioModel as FuncionarioModel;

$Pedido = new PedidoModel($pdo);
$Item = new ItemModel($pdo);
$Client = new ClientModel($pdo);
$Servico = new ServicoModel($pdo);
$Funcionario = new FuncionarioModel($pdo);

$Pedidos = $Pedido->junto();

$id_pedido = null;
$id_item = null;
$i = 0;

if (!empty($_POST['id_pedido'])){
    $id_item = $_POST['id_item'];
    $id_pedido = $_POST['id_pedido'];

    try {
        $Item->deleteByID($id_item);
        $Pedido->deleteByID($id_pedido);
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
            <a href="http://localhost/javalato/"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <h2><strong>Pedidos</strong></h2>
        </div>
        <a href="http://localhost/javalato/pages/create/createPedido.php"><button type="submit" class="btn btn-success btn-md float-right">Inserir</button></a><br>&nbsp
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Data</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Serviços</th>
                    <th scope="col">Funcionário</th>
                    <th scope="col">Total(R$)</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Pedidos as $dado):?>
                    <tr>
                        <td class="table-info"><?php echo $i += 1;?></td>
                        <td><?php echo htmlspecialchars($dado['id_pedido']); ?></td>
                        <td><?php echo htmlspecialchars($dado['order_date']); ?></td>
                        <td><a href=""></a><?php echo htmlspecialchars($Client->showByCPF($dado['cpf_cliente'])['nome']);?></td>
                        <td><?php echo htmlspecialchars($Servico->showByID($dado['id_servico'])['nome']).'R$'.htmlspecialchars($Servico->showByID($dado['id_servico'])['preco']).'.00';?></td>
                        <td><?php echo htmlspecialchars($Funcionario->showByID($dado['id_funcionario'])['nome']);?></td>
                        <td><?php echo 'R'.htmlspecialchars($dado['preco_total']);?></td>
                        <td>
                            <div class="form-check-inline">
                                <form action="pedidos.php" method="post">
                                    <input type="hidden" name="id_pedido" value="<?php echo htmlspecialchars($dado['id_pedido']);?>">
                                    <input type="hidden" name="id_item" value="<?php echo htmlspecialchars($dado['id_item']);?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\PedidoModel as PedidoModel;
use conpostgres\ItemModel as ItemModel;
use conpostgres\ClientModel as ClientModel;
use conpostgres\ServicoModel as ServicoModel;

$Pedido = new PedidoModel($pdo);
$Item = new ItemModel($pdo);
$Client = new ClientModel($pdo);
$Servico = new ServicoModel($pdo);

$Pedidos = $Pedido->all();
$Itens = $Item->all();

$id = null;
$i = 0;

if (!empty($_POST['id_pedido'])){
    $id = $_POST['id_pedido'];
    try {
        $Pedido->deleteByID($id);
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}

?>
<?php
require '../templates/header.php';
?>
<div class="col-sm-12" style="margin-top: 30px;">
    <div class="form-inline">
        <a href="http://localhost/javalato/"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <h2><strong>Compras</strong></h2>
    </div>
    <a href="http://localhost/javalato/pages/create/createPedido.php"><button type="submit" class="btn btn-success btn-md float-right">Inserir</button></a><br>&nbsp
    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nº do Pedido</th>
        <th scope="col">Cliente</th>
        <th scope="col">Serviços</th>
        <th scope="col">Funcionário</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Total(R$)</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Pedido as $dado):?>
            <tr>
            <td><?php echo $i += 1;?></td>
            <td><?php echo htmlspecialchars($dado['numero']); ?></td>
            <td><?php echo htmlspecialchars($Client->showByCPF($dado['cpf'])['nome']);?></td>
            <td><?php echo htmlspecialchars($Servico->showByID($item['id_servico']));?></td>
            <td><?php echo htmlspecialchars($dado['quantidade']);?></td>
            <td><?php echo htmlspecialchars(int($Servico->showByID($item['preco']))*int($dado['quantidade']));?></td>
            <td>
                <div class="form-check-inline">
                    <form action="pedidos.php" method="post">
                        <input type="hidden" name="id_pedido" value="<?php echo htmlspecialchars($dado['id_pedido']);?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                    </form>
                </div>
            </td>
            </tr>
        <?php endforeach;?>
    </tbody>
    </table>
</div>
</body>
</html>
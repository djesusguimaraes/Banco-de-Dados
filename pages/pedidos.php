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
$Servico = new ServicoModel($pdo);
$Client = new ClientModel($pdo);
$Funcionario = new FuncionarioModel($pdo);

$Pedidos = $Pedido->junto();
$Servicos = $Servico->all();

$id_pedido = null;
$id_item = null;
$i = 0;
$j = 0;

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
    <div class="form-inline" style="margin: 30px auto auto 50px;">
            <a href="http://localhost/javalato/"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <h2><strong>Pedidos</strong></h2>
    </div>
    <div>
        <div class="list-group float-left col-lg-2 row" style="margin: 5px auto auto 50px;">
            <h4 style="color:#005484; margin-bottom: 5px;"><strong>NOSSOS SERVIÇOS!</strong></h4><br>
            <?php foreach ($Servicos as $dado):?>
            <div href="#" class="list-group-item list-group-item-action flex-column align-items-start" style="border: 1px solid #005484; border-radius: 0px;">
                <div class="d-flex w-100 justify-content-between">
                <h6 class="" style="color: #005484;"><strong><?php echo htmlspecialchars($dado['nome']);?></strong></h6>
                <small style="color: #00897C;"><?php echo 'R$'.htmlspecialchars($dado['preco']).'.00';?></small>
                </div>
                <p class="mb-1" style="font-size: 11pt;"><?php echo htmlspecialchars($dado['descricao']);?></p>
            </div><br>
            <?php endforeach;?>
        </div>
        <div class="container" style="margin-top: 80px;">
                <h3 style="margin-bottom: -40px;">Histórico de Pedidos</h3>
                <div class="float-right">
                    <span>Já é cliente?  </span><a href="http://localhost/javalato/pages/create/createPedido.php"><button type="button" class="btn btn-success btn-md">Fazer Pedido</button></a>&nbsp<span>Ainda não é cliente? </span><a href="http://localhost/javalato/pages/create/createCliente.php"><button type="button" class="btn btn-warning btn-md">Cadastre-se já!</button></a><br>&nbsp
                </div>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th style="background-color: #005484;" scope="col">#</th>
                                <th style="background-color: #005484;" scope="col">Data</th>
                                <th style="background-color: #005484;" scope="col">Cliente</th>
                                <th style="background-color: #005484;" scope="col">Serviços</th>
                                <th style="background-color: #005484;" scope="col">Funcionário</th>
                                <th style="background-color: #005484;" scope="col">Total(R$)</th>
                                <th style="background-color: #005484;" scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Pedidos as $dado):?>
                                <tr>
                                    <td class="table-info"><?php echo htmlspecialchars($dado['id_pedido']); ?></td>
                                    <td style="font-size: 10pt;"><?php echo htmlspecialchars($dado['order_date']); ?></td>
                                    <td><?php echo htmlspecialchars($Client->showByCPF($dado['cpf_cliente'])['nome']);?></td>
                                    <td><?php echo htmlspecialchars($Servico->showByID($dado['id_servico'])['nome']).'(R$'.htmlspecialchars($Servico->showByID($dado['id_servico'])['preco']).'.00)';?></td>
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
        </div>
    </div>
</body>
</html>
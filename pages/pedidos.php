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
$texto = null;
$i = 0;
$j = 0;

if (!empty($_POST['del_pedido'])){
    $id_pedido = $_POST['del_pedido'];
    $id_item = $Item->getID($id_pedido)['id_item'];
    $texto = "
    <div class=\"alert alert-warning\" style=\"box-shadow: inset 0 0 1em gold;\" role=\"alert\">
        <form action=\"http://localhost/javalato/pages/pedidos.php\" method=\"post\">
            <div class=\"\">
                Você quer realmente apagar o pedido $id_pedido ?
                <input type=\"hidden\" name=\"id_pedido\" value=\"$id_pedido\">
                <input type=\"hidden\" name=\"id_item\" value=\"$id_item\">
            </div><br>
            <input type=\"button\" class=\"btn btn-success btn-sm\" name=\"cancel\" value=\"Cancelar\" onClick=\"window.location='http://localhost/javalato/pages/pedidos.php';\" />
            <button type=\"submit\" name=\"apagou\" class=\"btn btn-outline-danger btn-sm\">Confirmar</button>
        </form>&nbsp
    </div>";
}

if (!empty($_POST['id_pedido'])){
    if (empty($_POST['cancel'])){
        $id_item = $_POST['id_item'];
        $id_pedido = $_POST['id_pedido'];
    }

    try {
        $Item->deleteByID($id_item);
        $Pedido->deleteByID($id_pedido);
        header('Location: http://localhost/javalato/pages/pedidos.php');
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo $error;
    }
}

?>
<?php
require '../templates/header.php';
?>
    <div class="form-inline" style="margin: 50px auto auto 50px;">
            <a href="http://localhost/javalato/"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>
            <h2 style="margin: 3px auto auto 30px;">Compras</h2>
    </div>
    <div class="row">
        <div class="list-group float-left col-sm-4 row" style="margin: 85px auto 150px 50px;">
            <h4 style="color:#005484; margin-bottom: 5px;"><strong>CONHEÇA NOSSOS SERVIÇOS!</strong></h4><br>
            <?php foreach ($Servicos as $dado):?>
                <div href="#" class="list-group-item list-group-item-action flex-column align-items-start" style="border: 1px solid #005484; border-radius: 0px; box-shadow: 0px -2px 3px #ccc;">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="" style="color: #005484;"><strong><?php echo htmlspecialchars($dado['nome']);?></strong></h6>
                        <small style="color: #00897C;"><?php echo 'R$'.htmlspecialchars($dado['preco']).'.00';?></small>
                    </div>
                    <p class="mb-1" style="font-size: 11pt;"><?php echo htmlspecialchars($dado['descricao']);?></p>
                </div>
            <?php endforeach;?>
        </div>
        <div class="col-sm-7 float-right" style="margin: 80px 50px auto auto;">
            <h3 class="col-sm-5" style="margin-bottom: -55px;">Histórico de Pedidos</h3>
            <div class="float-right" style="margin-bottom: 15px;">
                <div class="form-check-inline">
                    <div class="col-sm-7">
                        <small>Ainda não é cliente?</small><br><a href="http://localhost/javalato/pages/create/createCliente.php" ><button type="button" class="btn btn-warning btn-md" style="box-shadow: 0px 0px 3px #ccc;">Cadastre-se já!</button></a>
                    </div>
                    <div class="col-sm-6">
                        <small>Já é cliente?</small><br>
                        <a href="http://localhost/javalato/pages/create/createPedido.php"><button type="button" class="btn btn-success btn-md">Fazer Pedido</button></a>
                    </div>
                </div>
            </div>
            <div>
                <div style="margin: 80px auto 20px auto;">
                    <?php echo $texto; ?>
                </div>
                <table class="table" style="border-bottom: 1px solid #005484; border-right: 1px solid #005484; border-left: 1px solid #005484; box-shadow: 0px 3px 5px #ccc; margin-bottom: 150px;">
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
                            <tr style="font-size: 11pt;">
                                <td class="table-info" style="border-right: 1px solid #005484;"><strong><?php echo htmlspecialchars($dado['id_pedido']); ?></strong></td>
                                <td style="font-size: 10pt;"><?php echo htmlspecialchars($dado['order_date']); ?></td>
                                <td><?php echo htmlspecialchars($Client->showByCPF($dado['cpf_cliente'])['nome']);?></td>
                                <td><?php echo htmlspecialchars($Servico->showByID($dado['id_servico'])['nome']).'(R$'.htmlspecialchars($Servico->showByID($dado['id_servico'])['preco']).'.00)';?></td>
                                <td><?php echo htmlspecialchars($Funcionario->showByID($dado['id_funcionario'])['nome']);?></td>
                                <td><?php echo 'R'.htmlspecialchars($dado['preco_total']);?></td>
                                <td>
                                    <div class="form-check-inline">
                                        <form action="pedidos.php" method="post">
                                            <input type="hidden" name="del_pedido" value="<?php echo htmlspecialchars($dado['id_pedido']);?>">
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
<?php
include('../templates/footer.php');
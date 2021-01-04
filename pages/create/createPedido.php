<?php
require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\ClientModel as ClientModel;
use conpostgres\ServicoModel as ServicoModel;
use conpostgres\FuncionarioModel as FuncionarioModel;
use conpostgres\ItemModel as ItemModel;
use conpostgres\PedidoModel as PedidoModel;

$Client = new ClientModel($pdo);
$Servico = new ServicoModel($pdo);
$Funcionario = new FuncionarioModel($pdo);
$Item = new ItemModel($pdo);
$Pedido = new PedidoModel($pdo);
$date = new DateTime('now');


$Clientes = $Client->all();
$Servicos = $Servico->all();
$Funcionarios = $Funcionario->all();


$cpf = null;
$id_servico = null; 
$id_funcionario = null;
$quantidade = null;
$data = null;
$url = null;
$texto = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
    $id_funcionario = isset($_POST['id_funcionario']) ? $_POST['id_funcionario'] : '';
    $order_date = isset($_POST['data']) ? $_POST['data'] : '';
    $id_servico = isset($_POST['id_servico']) ? $_POST['id_servico'] : '';
    $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
    $id_pedido = isset($_POST['id_pedido']) ? $_POST['id_pedido'] : '';
    $servicos = $Servico->showByID($id_servico);
    $preco_total = $quantidade * $servicos['preco'];

    try {
        $Pedido->insert($cpf, $id_funcionario, $order_date, $id_pedido, $preco_total);
        $Item->insert($id_pedido, $id_servico, $quantidade);
        $url = 1;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        $url = $error;
    }
}
if ($url == 1){
    $texto = ("<div class=\"alert alert-success\" role=\"alert\">Seu pedido foi anotado! Agradecemos a preferência!<a href=\"http://localhost/javalato/pages/pedidos.php\" ><button class=\"btn btn-outline-success btn-sm float-right\" style=\"padding: 5px; margin-top: -4px;\">Voltar à seleção</button></a></div>");
}else if($url != null){
    $texto = ("<div class=\"alert alert-danger\" role=\"alert\">$url<a href=\"http://localhost/javalato/pages/pedidos.php\" ><button class=\"btn btn-outline-danger btn-sm float-right\" style=\"padding: 5px; margin-top: 0px;\">Voltar à seleção</button></a></div>");
}
?>
<?php
    require '../../templates/header.php';
?>
<div class="container" style="margin-top: 30px;">
    <div class="form-inline">
        <a href="http://localhost/javalato/pages/pedidos.php"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <h2><strong>Pedido</strong></h2><br>
    </div><br>
    <?php echo $texto;?>
    <form action="createPedido.php" method="post">
        <div class="form-group">
            <label for="cpf">Nome do Cliente</label>
            <select class="form-control" id="cpf" name="cpf" value="" required>
                <option value="" disabled selected>Selecione o Cliente</option>
                <?php foreach ($Clientes as $dado) : ?>
                    <?php if ($dado['delete_at'] == null) : ?>
                        <tr>
                            <option value="<?php echo htmlspecialchars($dado['cpf']); ?>"> <?php echo htmlspecialchars($dado['nome']); ?></option>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <small id="help" class="form-text text-muted">Campo Obrigatório</small>
        </div>
        <div class="form-group">
            <label for="id_servico">Serviço</label>
            <select class="form-control" id="id_servico" name="id_servico" value="" required>
                <option value="" disabled selected>Selecione o Serviço</option>
                <?php foreach ($Servicos as $dado) : ?>
                    <tr>
                        <option value="<?php echo htmlspecialchars($dado['id_servico']); ?>"><?php echo htmlspecialchars($dado['nome']).'(R$'.htmlspecialchars($dado['preco']).'.00)'; ?></option>
                    </tr>
                <?php endforeach; ?>
            </select>
            <small id="help" class="form-text text-muted">Campo Obrigatório</small>
        </div>
        <div class="form-group">
            <label for="id_funcionario">Funcionário</label>
            <select class="form-control" id="id_funcionario" name="id_funcionario" value="" required>
                <option value="" disabled selected>Selecione o Funcionário</option>
                <?php foreach ($Funcionarios as $dado) : ?>
                    <tr>
                        <option value="<?php echo htmlspecialchars($dado['id_funcionario']); ?>"> <?php echo htmlspecialchars($dado['nome']); ?></option>
                    </tr>
                <?php endforeach; ?>
            </select>
            <small id="help" class="form-text text-muted">Campo Obrigatório</small>
        </div>
        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="number" class="form-control" name="quantidade" id="quantidade" placeholder="Ex: 3">
        </div>
        <input type="hidden" name="data" id="data" value="<?php echo $date->format('Y-m-d');?>">
        <input type="hidden" name="id_pedido" id="id_pedido" value="<?php echo $Pedido->last() + 1;?>">
        <br>

    <button type="submit" class="btn btn-primary" >Enviar</button>&nbsp&nbsp&nbsp<input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/pedidos.php';" /> 
    </form>

</div>
</body>
</html>
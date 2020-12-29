<?php
require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\ClientModel as ClientModel;
use conpostgres\ServicoModel as ServicoModel;
use conpostgres\ItemModel as ItemModel;
use conpostgres\PedidoModel as PedidoModel;

$Client = new ClientModel($pdo);
$Servico = new ServicoModel($pdo);
$Item = new ItemModel($pdo);
$Pedido = new PedidoModel($pdo);

$Clientes = $Client->all();
$Servicos = $Servico->all();

?>
<?php
    require '../templates/header.php';
?>
<div class="container" style="margin-top: 30px;">
    <div class="form-inline">
        <a href="http://localhost/javalato/"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <h2><strong>Compras</strong></h2><br>
    </div><br>
    
    <form action="buy.php" method="post">
            <div class="form-group">
                <label for="cpf">Nome do Cliente</label>
                <select class="form-control" id="cpf" name="cpf" value="" required>
                    <option value="" disabled selected>Selecione o Cliente</option>
                    <?php foreach ($Clientes as $dado) : ?>
                        <tr>
                            <option value="<?php echo htmlspecialchars($dado['cpf']); ?>"> <?php echo htmlspecialchars($dado['nome']); ?></option>
                        </tr>
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
                            <option value="<?php echo htmlspecialchars($dado['id_servico']); ?>"> <?php echo htmlspecialchars($dado['nome']); ?></option>
                        </tr>
                    <?php endforeach; ?>
                </select>
                <small id="help" class="form-text text-muted">Campo Obrigatório</small>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" class="form-control" name="quantidade" id="quantidade" placeholder="Ex: 3">
            </div><br>
    <button type="submit" class="btn btn-primary" >Enviar</button>&nbsp&nbsp&nbsp<input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/clientes.php';" /> 
    </form>

</div>
</body>
</html>
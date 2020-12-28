<?php
require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\ClientModel as ClientModel;

$Client = new ClientModel($pdo);

$cpf = null;
$nome = null;
$telefone = null;
$carro = null;
$placa = null;

if(!empty($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}

$Cliente = $Client -> showByCPF($cpf);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = isset($_REQUEST['nome']) ? $_REQUEST['nome'] : $Cliente['nome'];
    $telefone = isset($_REQUEST['telefone']) ? $_REQUEST['telefone'] : $Cliente['telefone'];
    $carro = isset($_REQUEST['carro']) ? $_REQUEST['carro'] : $Cliente['carro'];
    $placa = isset($_REQUEST['placa']) ? $_REQUEST['placa'] : $Cliente['placa'];
    $cpf = $Cliente['cpf'];

    try {
        $Client -> update($nome, $telefone, $carro, $placa, $cpf);
    }catch (PDOExpection $expection) {
        $error = $expection -> getMessage();
    }
}
?>
<?php 
    require '../../templates/header.php';
?>

    <div class="container-sm">
        <h2><strong>Update Cliente <?php echo htmlspecialchars($Cliente['cpf'])?></strong></h2><br>

        <?php if(!empty($_POST['cpf'])): ?>
            <form action="upCliente.php" method="post">
                <fieldset>
                    <legend>Dados do Cliente</legend>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="<?php echo isset($Cliente['nome']) ? $Cliente['nome'] : 'Digite novo nome' ?>" >
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" oninput="mascara(this, 'tel')" class="form-control" name="telefone" id="telefone" placeholder="<?php echo isset($Cliente['telefone']) ? $Cliente['telefone'] : 'Digite nova telefone' ?>" >
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Dados do Veículo</legend>
                    <div class="form-group">
                        <label for="carro">Carro(Modelo/Ano)</label>
                        <input type="text" class="form-control" name="carro" id="carro" placeholder="<?php echo isset($Cliente['carro']) ? $Cliente['carro'] : 'Digite novo carro' ?>" >
                    </div>
                    <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control" name="placa" id="placa" placeholder="<?php echo isset($Cliente['placa']) ? $Cliente['placa'] : 'Digite nova placa' ?>" >
                    </div>
                </fieldset>                
                <input type="hidden" name="cpf" id="cpf" value="<?php echo $Cliente['cpf'];?>">
                <button type="submit" class="btn btn-primary">Update</button>
                <input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/clientes.php';" />
            </form>
        <?php endif ?>
    </div>
</body>
</html>
<?php
require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\ClientModel as ClientModel;

$Client = new ClientModel($pdo);

$cpf = null;
$nome = null;
$telefone = null;
$texto = null;
$url = null;

if(!empty($_POST['cpf'])){
    $cpf = $_POST['cpf'];
}

if(!empty($_GET['cpf'])){
    $cpf = $_GET['cpf'];
    $texto = $_GET['texto'];
}

$Cliente = $Client -> showByCPF($cpf);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = isset($_REQUEST['nome']) ? $_REQUEST['nome'] : $Cliente['nome'];
    $telefone = isset($_REQUEST['telefone']) ? $_REQUEST['telefone'] : $Cliente['telefone'];
    $cpf = isset($_REQUEST['cpf']) ? $_REQUEST['cpf'] : $Cliente['cpf'];

    try {
        if (!empty($_REQUEST['nome'])){
            $Client -> update($nome, $telefone, $cpf);
            $texto = ("<div class=\"alert alert-success\" role=\"alert\">Cliente atualizado com sucesso!</div>");
        }
        header('Location: http://localhost/javalato/pages/update/upCliente.php?cpf='.$cpf.'&texto='.$texto);
    }catch (PDOExpection $expection) {
        $error = $expection -> getMessage();
    }
}
    
?>

<?php 
    require '../../templates/header.php';
?>

    <div class="container-sm" style="margin-top: 30px;">
        <div class="form-inline">
            <a href="http://localhost/javalato/pages/clientes.php"><img src="http://localhost/javalato/assets/images/back.png" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <h2><strong>Update Cliente <?php echo htmlspecialchars($Cliente['cpf'])?></strong></h2>
        </div><br>
            <?php echo $texto;?>
            <form action="#" method="post">
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
                </fieldset><br>     
                <input type="hidden" name="cpf" id="cpf" value="<?php echo $Cliente['cpf'];?>">
                <button type="submit" class="btn btn-primary"> Update </button>
                <input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/clientes.php';" />
            </form>
    </div>
</body>
</html>
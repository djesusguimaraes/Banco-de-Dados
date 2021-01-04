<?php
require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\ServicoModel as ServicoModel;

$Servico = new ServicoModel($pdo);

$id = null;
$nome = null;
$descricao = null;
$preco = null;

if(!empty($_POST['id_servico'])){
    $id = $_POST['id_servico'];
}

if(!empty($_GET['id_servico'])){
    $id = $_GET['id_servico'];
    $texto = $_GET['texto'];
}

$Servicos = $Servico -> showByID($id);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = isset($_REQUEST['nome']) ? $_REQUEST['nome'] : $Servicos['nome'];
    $descricao = isset($_REQUEST['descricao']) ? $_REQUEST['descricao'] : $Servicos['descricao'];
    $preco = isset($_REQUEST['preco']) ? $_REQUEST['preco'] : $Servicos['preco'];
    $id = $_REQUEST['id_servico'];

    try {
        if (!empty($_REQUEST['nome'])){
            $Servico -> update($nome, $descricao, $preco, $id);
            $texto = ("<div class=\"alert alert-success\" role=\"alert\">Informações de serviço atualizadas com sucesso!<a href=\"http://localhost/javalato/pages/adm.php\" ><button class=\"btn btn-outline-success btn-sm float-right\" style=\"padding: 5px; margin-top: -4px;\">Voltar à seleção</button></a></div>");
        }
        header('Location: http://localhost/javalato/pages/update/upServico.php?id_servico='.$id.'&texto='.$texto);
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
            <a href="http://localhost/javalato/pages/adm.php"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <h2><strong>Update Serviço <?php echo htmlspecialchars($Servicos['id_servico'])?></strong></h2><br>
        </div><br>

        <?php if(!empty($_GET['id_servico'])): ?>
            <?php echo $texto;?>
            <form action="upServico.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="<?php echo isset($Servicos['nome']) ? $Servicos['nome'] : 'Digite novo nome' ?>" >
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao" placeholder="<?php echo isset($Servicos['descricao']) ? $Servicos['descricao'] : 'Digite nova descrição' ?>" >
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    <input type="number" class="form-control" name="preco" id="preco" placeholder="<?php echo isset($Servicos['preco']) ? $Servicos['preco'] : 'Digite novo preço' ?>" >
                </div><br>
                <input type="hidden" name="id_servico" id="id_servico" value="<?php echo $Servicos['id_servico'];?>">
                <button type="submit" class="btn btn-primary">Update</button>
                <input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/adm.php';" />
            </form>
        <?php endif ?>
    </div>
</body>
</html>
<?php
require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\FuncionarioModel as FuncionarioModel;

$Funcionario = new FuncionarioModel($pdo);


$id = null;
$nome = null;
$cpf = null;
$telefone = null;

if(!empty($_POST['id_funcionario'])){
    $id = $_POST['id_funcionario'];
}

if(!empty($_GET['id_funcionario'])){
    $id = $_GET['id_funcionario'];
    $texto = $_GET['texto'];
}

$Funcionarios = $Funcionario->showByID($id);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = isset($_REQUEST['nome']) ? $_REQUEST['nome']: $Funcionarios['nome'];
    $cpf = isset($_REQUEST['cpf']) ? $_REQUEST['cpf']: $Funcionarios['cpf'];
    $telefone = isset($_REQUEST['telefone']) ? $_REQUEST['telefone']: $Funcionarios['telefone'];
    $id = $_REQUEST['id_funcionario'];

    try {
        if (!empty($_REQUEST['nome'])){
            $Funcionario-> update($nome, $cpf, $telefone, $id);
            $texto = ("<div class=\"alert alert-success\" role=\"alert\">Informações do funcionário atualizadas com sucesso!<a href=\"http://localhost/javalato/pages/adm.php\" ><button class=\"btn btn-outline-success btn-sm float-right\" style=\"padding: 5px; margin-top: -4px;\">Voltar à seleção</button></a></div>");
        }
        header('Location: http://localhost/javalato/pages/update/upFuncionario.php?id_funcionario='.$id.'&texto='.$texto);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}

?>

<?php
    require '../../templates/header.php';
?>
    <div class="container-sm"  style="margin-top: 30px;">
        <div class="form-inline">
            <a href="http://localhost/javalato/pages/adm.php"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <h2><strong>Update Funcionário <?php echo htmlspecialchars($Funcionarios['id_funcionario'])?></strong></h2>
        </div><br>
        <?php if(!empty($_GET['id_funcionario'])):?>
            <?php echo $texto; ?>
            <form action="upFuncionario.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" max-lenght="80" name="nome" id="nome" placeholder="<?php echo isset($Funcionarios['nome']) ? $Funcionarios['nome'] : 'Digite novo nome';?>" >
                </div>
                
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" oninput="mascara(this, 'cpf');" class="form-control" max-lenght="14" name="cpf" id="cpf" placeholder="<?php echo isset($Funcionarios['cpf']) ? $Funcionarios['cpf'] : 'Digite novo cpf';?>" >
                </div>
                
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" oninput="mascara(this, 'tel');" class="form-control" max-lenght="14" name="telefone" id="telefone" placeholder="<?php echo isset($Funcionarios['telefone']) ? $Funcionarios['telefone'] : 'Digite novo telefone';?>">
                </div><br>
                <input type="hidden" name="id_funcionario" id="id_funcionario" value="<?php echo $Funcionarios['id_funcionario'];?>">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/adm.php';" />
            </form>
        <?php endif ?>
    </div>
</body>

</html>

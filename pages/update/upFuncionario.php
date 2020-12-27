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

$Funcionarios = $Funcionario->showByID($id);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = isset($_REQUEST['nome']) ? $_REQUEST['nome']: $Funcionarios['nome'];
    $cpf = isset($_REQUEST['cpf']) ? $_REQUEST['cpf']: $Funcionarios['cpf'];
    $telefone = isset($_REQUEST['telefone']) ? $_REQUEST['telefone']: $Funcionarios['telefone'];
    $id = $_REQUEST['id_funcionario'];

    try {
        $Funcionario-> update($nome, $cpf, $telefone, $id);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
        echo 'Mensagem de erro: '.$error;
    }
}

?>

<?php
    require '../../templates/header.php';
?>
    <div class="container-sm">
        <h2><strong>Update Funcionário</strong></h2><br>
        <?php if(!empty($_POST['id_funcionario'])):?>
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
                </div>
                <input type="hidden" name="id_funcionario" id="id_funcionario" value="<?php echo $Funcionarios['id_funcionario'];?>">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <input type="button" class="btn btn-outline-danger" name="cancel" value="Cancel" onClick="window.location='http://localhost/javalato/pages/funcionarios.php';" />
            </form>
        <?php endif ?>
    </div>
</body>

</html>

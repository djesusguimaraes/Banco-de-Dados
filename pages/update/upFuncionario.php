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
    echo $id;
}

$Funcionarios = $Funcionario->showByID($id);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_REQUEST['nome'];
    $cpf = $_REQUEST['cpf'];
    $telefone = $_REQUEST['telefone'];
    $id = $_REQUEST['id_funcionario'];

    echo $nome;    
    echo $id;

    try {
        $Funcionario->update($nome, $cpf, $telefone, $id);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}

?>

<?php
require '../../templates/header.php';
?>
    <div class="container">
    
    </div>

    <div class="container-sm">
        <h2><strong>Update Funcionário</strong></h2><br>
        <?php if(!empty($_POST['id_funcionario'])):?>
        <form action="upFuncionario.php" method="post">
            <fieldset>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" max-lenght="80" name="nome" id="nome" placeholder="Digite Novo nome" >
                </div>
                
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" max-lenght="14" name="cpf" id="cpf" placeholder="Digite Novo CPF" >
                </div>
                
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" max-lenght="14" name="telefone" id="telefone" placeholder="Digite Novo Telefone">
                </div>
                <input type="hidden" name="id_funcionario" id="id_funcionario" value="<?php echo $Funcionarios['id_funcionario'];?>">
            </fieldset>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php endif ?>
    </div>
</body>

</html>

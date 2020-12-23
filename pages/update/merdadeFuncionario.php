<?php
require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\FuncionarioModel as FuncionarioModel;

$Funcionario = new FuncionarioModel($pdo);

$id = null;
$nome = null;
$cpf = null;
$telefone = null;
$nomeAtual = null;
$cpfAtual = null;
$telefoneAtual = null;


if (!empty($_GET['id_funcionario'])) {
    $id = $_GET['id_funcionario'];
    $Funcionarios = $Funcionario->showByID($id);

    echo $id;

    $nomeAtual = $Funcionarios['nome'];
    $cpfAtual = $Funcionarios['cpf'];
    $telefoneAtual = $Funcionarios['telefone'];
}

echo $id;

if ($id) {

    $nome = isset($_REQUEST['nome']);
    $cpf = isset($_REQUEST['cpf']);
    $telefone = isset($_REQUEST['telefone']);
    
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
        <form action="upFuncionario.php" method="post">
            <fieldset>
                <div class="form-group">
                    <label for="nome">Nome: <?php echo $nomeAtual?></label>
                    <input type="text" class="form-control" max-lenght="80" value="<?php echo !empty($nome) ? $nome : ''; ?>" name="nome" id="nome" placeholder="Digite Novo nome" >

                </div>
                <div class="form-group">
                    <label for="cpf">CPF: <?php echo $cpfAtual?></label>
                    <input type="text" class="form-control" max-lenght="14" value="<?php echo !empty($cpf) ? $cpf : ''; ?>" name="cpf" id="cpf" placeholder="Digite Novo CPF" >
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone: <?php echo $telefoneAtual?></label>
                    <input type="text" class="form-control" max-lenght="11" value="<?php echo !empty($telefone) ? $telefone : ''; ?>" name="telefone" id="telefone" placeholder="Digite Novo Telefone">
                </div>
            </fieldset>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>

</html>

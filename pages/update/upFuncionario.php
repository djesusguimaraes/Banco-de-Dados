<?php
require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\FuncionarioModel as FuncionarioModel;

$Funcionario = new FuncionarioModel($pdo);

$id = null;

if (!empty($_POST['id_funcionario'])) {
    $id = $_POST['id_funcionario'];
    $Funcionarios = $Funcionario->showByID($id);

    $nomeAtual = $Funcionarios['nome'];
    $cpfAtual = $Funcionarios['cpf'];
    $telefoneAtual = $Funcionarios['telefone'];
    $idAtual = $Funcionarios['id_funcionario'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // $nome = ;
    // $cpf = ;
    // $telefone = ;
    
    try {
        $Funcionario->update($_REQUEST['nome'], $_REQUEST['cpf'], $_REQUEST['telefone'], $id);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}

?>

<?php
require '../../templates/header.php';
?>

    <div class="container-sm">
        <h2><strong>Update Funcionário</strong></h2>
        <form action="upFuncionario.php" method="post">
            <fieldset>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" max-lenght="80" name="nome" id="nome" placeholder="<?php echo htmlspecialchars($nomeAtual)?>">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" max-lenght="14" name="cpf" id="cpf" placeholder="<?php echo htmlspecialchars($cpfAtual)?>">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" max-lenght="5" name="telefone" id="telefone" placeholder="<?php echo htmlspecialchars($telefoneAtual)?>">
                </div>
            </fieldset>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>

</html>

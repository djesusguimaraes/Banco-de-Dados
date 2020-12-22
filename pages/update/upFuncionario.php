<?php
require '../../database/models.php';

include_once '../../database/ini.php';

use conpostgres\FuncionarioModel as FuncionarioModel;

$Funcionario = new FuncionarioModel($pdo);

$id = null;
$nome = null;
$cpf = null;
$telefone = null;

if (!empty($_POST['id_funcionario'])) {
    $id = $_POST['id_funcionario'];
}

$Funcionarios = $Funcionario->showByID($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_REQUEST['nome'];
    $cpf = $_REQUEST['cpf'];
    $telefone = $_REQUEST['telefone'];
    
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

    <div class="container-sm">
        <h2><strong>Update Funcionário</strong></h2>
        <form action="upFuncionario.php" method="post">
            <fieldset>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" value="<?php echo !empty($nome) ? $nome : ' '; ?>" max-lenght="80" name="nome" id="nome" placeholder="<?php echo htmlspecialchars($Funcionarios['nome'])?>">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" value="<?php echo !empty($cpf) ? $cpf : ' '; ?>" max-lenght="14" name="cpf" id="cpf" placeholder="<?php echo htmlspecialchars($Funcionarios['cpf'])?>">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" value="<?php echo !empty($telefone) ? $telefone : ' '; ?>" max-lenght="5" name="telefone" id="telefone" placeholder="<?php echo htmlspecialchars($Funcionarios['telefone'])?>">
                </div>
            </fieldset>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>

</html>

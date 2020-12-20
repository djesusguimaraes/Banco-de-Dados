<?php

require '../bd/models/Funcionario.php';

include_once '../bd/db.ini.php';

use connPHPPostgres\FuncionarioModel as FuncionarioModel;
$funcionarioRegister = new FuncionarioModel($pdo);

$Nome_funcionario = null;
$CPF = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Nome_funcionario =  $_REQUEST['nome'];
    $CPF =  $_REQUEST['cpf'];
    
    // $ID_servico =  $_REQUEST['servico'];

    try {
        $funcionarioRegister->insert($_REQUEST['nome'], $_REQUEST['cpf']);
    } catch (PDOException $exception) {
        $error = $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    <title>Adicionar novo dependente</title>
</head>

<body>
    <div class="container">

        <div class="row py-5">
            <div class="col">
                <h4>Cadastrar novo funcionario</h4>
            </div>
            <div class="col"></div>
        </div>

        <form action="CadastroFuncionario.php" method="post">
            <!-- Alerta em caso de erro -->
            <?php if (!empty($error)) : ?>
                <span class="text-danger"><?php echo $error; ?></span>
            <?php endif; ?>

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input class="form-control" value="<?php echo !empty($Nome_funcionario) ? $Nome_funcionario : ''; ?>" type="text" name="nome" id="nome" required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input class="form-control" type="text" value="<?php echo !empty($CPF) ? $CPF : ''; ?>" name="cpf" id="cpf" required>
            </div>

            <input class="btn btn-primary" type="submit" value="Cadastrar">

        </form>
    </div>

</body>

</html>
<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\FuncionarioModel as FuncionarioModel;

$Funcionario = new FuncionarioModel($pdo);

$Funcionarios = $Funcionario->all();

$id = null;

if (!empty($_POST['id_funcionario'])) {
    $id = $_POST['id_funcionario'];
    try {
        $Funcionario->deleteByID($id);
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}

?>
<?php
require '../templates/header.php';
?>
<div class="container-lg">
<h2><strong>Funcionários</strong></h2>
    <table class="table">
    <thead class="thead-light">
        <tr>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Telefone</th>
        <th scope="col">ID Funcionário</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Funcionarios as $dado) : ?>
            <tr>
            <td><?php echo htmlspecialchars($dado['nome']); ?></td>
            <td><?php echo htmlspecialchars($dado['cpf']); ?></td>
            <td><?php echo htmlspecialchars($dado['telefone']); ?></td>
            <td><?php echo htmlspecialchars($dado['id_funcionario']); ?></td>
            <td>
            <div class="form-check-inline">
                <form action="funcionarios.php" method="post">
                    <input type="hidden" name="id_funcionario" value="<?php echo htmlspecialchars($dado['id_funcionario']); ?> ">&nbsp
                    <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                </form>
                <form action="update/upFuncionario.php" method="post">
                    <input type="hidden" name="id_funcionario" id="id_funcionario" value="<?php echo htmlspecialchars($dado['id_funcionario']); ?>">&nbsp&nbsp
                    <button type="submit" class="btn btn-outline-info btn-sm"?>Update</button>
                </form>
            </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
    
</div>
<div class="container">
    <a href="create/createFuncionario.php"><button type="button" class="btn btn-outline-success btn-lg">Insert</button></a>
</div>
</body>
</html>
<?php

require '../database/models.php';

include_once '../database/ini.php';

use conpostgres\FuncionarioModel as FuncionarioModel;

$Funcionario = new FuncionarioModel($pdo);

$Funcionarios = $Funcionario->all();

$id = null;
$i = 0;

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
<div class="container" style="margin-top: 30px;">
    <div class="form-inline">
        <a href="http://localhost/javalato/"><img src="http://localhost/javalato/assets/images/back.png" alt="" height="26"></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <h2><strong>Funcionários</strong></h2>
    </div>
    <a href="create/createFuncionario.php"><button type="button" class="btn btn-success btn-md float-right">Inserir</button></a><br>&nbsp
    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Telefone</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Funcionarios as $dado) : ?>
            <tr>
            <td class="table-info"><?php echo $i += 1;?></td>
            <td><?php echo htmlspecialchars($dado['id_funcionario']); ?></td>
            <td><?php echo htmlspecialchars($dado['nome']); ?></td>
            <td><?php echo htmlspecialchars($dado['cpf']); ?></td>
            <td><?php echo htmlspecialchars($dado['telefone']); ?></td>
            <td >
                <div class="form-check-inline">
                    <form action="funcionarios.php" method="post">
                        <input type="hidden" name="id_funcionario" value="<?php echo htmlspecialchars($dado['id_funcionario']); ?> ">
                        <button type="submit" class="btn btn-outline-danger btn-sm"?>Delete</button>
                    </form>
                    <form action="update/upFuncionario.php" method="post">
                        <input type="hidden" name="id_funcionario" id="id_funcionario" value="<?php echo htmlspecialchars($dado['id_funcionario']); ?>">&nbsp
                        <button type="submit" class="btn btn-outline-info btn-sm">Update</button>
                    </form>
                </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>
</body>
</html>